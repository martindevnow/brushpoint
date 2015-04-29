<?php

namespace Martin\Products;


use Illuminate\Support\Facades\Auth;
use Session;

// use Illuminate\Support\Facades\Session;

class CartRepository {

    public $user_id;
    public $unique_id;
    public $shippingAndHandling;
    // public $totalNumberOfItems;
    // public $totalWeight;

    function __construct()
    {
        $this->unique_id = Session::get('unique_id');
        if (Auth::user())
            $this->user_id = Auth::user()->id;
        else
            $this->user_id = 0;

        if (session()->has('shippingAndHandling'))
            $this->shippingAndHandling = session('shippingAndHandling');
    }

    public function getCartData()
    {

        return $this->getCartDataDB();

        $data = array();

        if (Session::has('cart'))
        {
            $carts = Session::get('cart');

            foreach ($carts as $id => $cart)
            {
                $data[] = [
                    'id'        => str_replace('item-', '', $id),
                    'name'      => $cart['name'],
                    'sku'       => $cart['sku'],
                    'product_id'       => $cart['product_id'],
                    'price'     => $cart['price'],
                    'quantity'  => $cart['quantity']
                ];
                // $this->totalNumberOfItems += $cart['quantity'];
            }
        }
        else
            return array();

        return $data;

    }


    /**
     * Gets the data for the cart from the DB
     *
     * @param null $identifier
     * @return array
     */
    public function getCartDataDB($identifier = null)
    {
        $data = array();

        if ($identifier)
            $carts = Cart::where('user_id', '=', $identifier)
                ->orWhere('unique_id', '=', $identifier);
        else
        {
            if ($this->user_id)
                $carts = Cart::where('user_id', '=', $this->user_id);
            else
                $carts = Cart::where('unique_id', '=', $this->unique_id);
        }

        foreach ($carts->get() as $cart)
        {
            if ($cart->unique_id != $this->unique_id)
            {
                $cart->unique_id = $this->unique_id;
                $cart->save();
            }

            $data['item-'. $cart->item_id] = [
                'id'        => $cart->item_id,
                'name'      => $cart->item->name,
                'sku'       => $cart->item->product->sku,
                'product_id'       => $cart->item->product->product_id,
                'price'     => $cart->price,
                'quantity'  => $cart->quantity
            ];
        }
        return $data;
    }


    /**
     * Check the total value of the guest's cart
     *
     * @param null $identifier
     * @return int
     */
    public function getCartTotal($identifier = null)
    {

        $total = 0;

        if ( ! Session::has('cart'))
            return $total;

        $cartItems = Session::get('cart');

        foreach ($cartItems as $cart)
            $total += $cart['price'] * $cart['quantity'];

        return $total;
    }


    /**
     * Get the total cost of the cart from the DB
     * @param null $identifier
     * @return int
     */
    public function getCartTotalDB($identifier = null)
    {

        $total = 0;
        if ($identifier)
            $cartItems = Cart::where('unique_id', '=', $identifier)
                ->orWhere('user_id', '=', $identifier)->get();
        else
            $cartItems = Cart::where('unique_id', '=', $this->unique_id)
                ->orWhere('user_id', '=', $this->user_id)->get();

        if ( ! $cartItems->count())
            return $total;

        foreach ($cartItems as $cart)
            $total += $cart->getCartExtendedPrice();

        return $total;
    }


    /**
     * Add an item to the guest's cart
     *
     * @param Item $item
     * @param $quantity
     * @return \Illuminate\Database\Eloquent\Collection|Cart|mixed|null|static[]
     */
    public function addToCart(Item $item, $quantity)
    {
        $cartId = $this->getCartIdentifier($item->id);

        if (Session::has($cartId)){
            $cart = Session::get($cartId);
            Session::put($cartId, [
                'name'      => $item->name,
                'sku'       => $item->product->sku,
                'product_id'       => $item->product->id,
                'price'     => $item->price,
                'quantity'  => $cart['quantity'] + $quantity
            ]);
        }
        else{
            Session::put($cartId, [
                'name'      => $item->name,
                'sku'       => $item->product->sku,
                'product_id'       => $item->product->id,
                'price'     => $item->price,
                'quantity'  => $quantity
            ]);
        }

        $cart = $this->addToCartDB($item, $quantity);


        return $cart;
    }


    /**
     * Add the item to the user's cart
     *
     * @param Item $item
     * @param $quantity
     * @return Cart
     */
    public function addToCartDB(Item $item, $quantity)
    {
        $cart = Cart::where('unique_id', '=', $this->unique_id)
            ->where('item_id', '=', $item->id)->get();

        if (!$cart->count())
        {
            $cart = new Cart();
            $cart->unique_id    = $this->unique_id;
            $cart->user_id      = $this->user_id;
            $cart->quantity     = $quantity;
            $cart->price        = $item->price;
            $cart->save();

            $item->carts()->save($cart);
        }
        else{

            $cart = $cart->first();
            $cart->quantity = $cart->quantity + $quantity;
            $cart->save();
        }

        $this->calculateShipping();

        return $cart;
    }


    /**
     * Calculate the cost of shipping
     *
     * @return float
     */
    public function calculateShipping()
    {
        /*if ($this->getCartTotal() >= 20)
            return 6.95;
        return 9.95;*/

        $shippingAndHandling = 0;

        if ($this->getTotalWeight() > 300)
            $shippingAndHandling = 5;
        if ($this->getTotalNumberOfItems() > 4)
            $shippingAndHandling = 5;
        if ($this->getThickness() > 20)
            $shippingAndHandling = 5;

        // ADD OTHER CONDITIONALS AND CALCULATIONS HERE
        if ($shippingAndHandling == 0)
            $shippingAndHandling = 4;

        $this->$shippingAndHandling = $shippingAndHandling;
        Session::put('shippingAndHandling', $shippingAndHandling);

        return $this->shippingAndHandling;


        /*
         * Here is where I could include other factors to ACTUALLY calculate the shipping cost.
         */
    }

    public function getShippingAndHandling()
    {
        if (!$this->shippingAndHandling)
            return $this->calculateShipping();

        return $this->shippingAndHandling;
    }



    public function getTotalWeight()
    {
        foreach ($this->getCartData() as $item)
            $productsArray[$item['product_id']] = $item['quantity'];

        $products = Product::whereIn('id', array_keys($productsArray))->get();;

        $weight = 0;
        foreach($products as $product)
            $weight += $product->unit_weight_g * $productsArray[$product->id];

        return $weight;
    }

    /**
     * Get an item from the cart DB based on the item id
     *
     * @param $id
     * @return mixed
     */
    public function getCartByItemId($id)
    {
        return Cart::where('item_id', '=', $id)
            ->where('unique_id', '=', Session::get('unique_id'))->first();
    }


    /**
     * Completely Empty the cart
     *
     * @param null $identifier
     */
    public function clearCart($identifier = null)
    {
        if (!$identifier)
            Session::forget('cart');

        $this->clearCartDB($identifier);
    }

    /**
     * Empty the cart from the DB
     *
     * @param null $identifier
     */
    public function clearCartDB($identifier = null)
    {
        if ($identifier)
            Cart::where('unique_id', '=', $identifier)->orWhere('user_id', '=', $identifier)->delete();
        else
            Cart::where('unique_id', '=', $this->unique_id)->orWhere('user_id', '=', $this->user_id)->delete();
    }


    /**
     * Remove an item from the cart DB
     *
     * @param $itemId
     */
    public function removeByItemId($itemId)
    {
        $cart = $this->getCartByItemId($itemId);
        $cart->delete();
        $this->refreshCartFromDB();
    }

    /**
     * Rebuild the session cart from the DB
     */
    public function refreshCartFromDB()
    {
        $this->calculateShipping();
        session()->put('cart', $this->getCartDataDB());
    }


    /**
     * Returns a string used to identify the item in the cart
     *
     * @param $id
     * @return string
     */
    public function getCartIdentifier($id)
    {
        return 'cart.item-'.$id;
    }

    public function updateQuantities(array $data)
    {
        foreach ($data as $cartItem => $quantity)
        {
            if ($quantity == 0)
            {
                $this->removeByItemId($cartItem[0]);
            }
            else{
                $cartItem = explode('-', $cartItem);
                // $items[$cartItem[0]] = $quantity;
                $cart = $this->getCartByItemId($cartItem[0]);
                $cart->quantity = $quantity;
                $cart->save();
            }

        }
        $this->refreshCartFromDB();

        // dd($items);
    }

    private function getTotalNumberOfItems()
    {
        $numberOfItems = 0;

        foreach ($this->getCartData() as $item)
            $numberOfItems += $item['quantity'];

        return $numberOfItems;
    }

    private function getThickness()
    {
        foreach ($this->getCartData() as $item)
            $productsArray[] = $item['product_id'];

        $products = Product::whereIn('id', $productsArray)->get();;

        $thicknessInMM = 0;
        foreach($products as $product)
            $thicknessInMM = max($thicknessInMM, $product->unit_depth_cm * 10);

        return $thicknessInMM;
    }
}



