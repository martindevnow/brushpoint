<?php

namespace Martin\Products;


use Illuminate\Support\Facades\Auth;
use Session;

// use Illuminate\Support\Facades\Session;

class CartRepository {

    // TODO: remove the reliance on sessions.
    // TODO: use only DB for storing cart stuff
    // TODO: Look up eager loading the product/item information for the cart

    public $user_id;
    public $unique_id;
    public $shippingAndHandling;

    public $data;

    // public $totalNumberOfItems;
    // public $totalWeight;

    function __construct()
    {
        $this->unique_id = session('unique_id');
        if (Auth::user())
            $this->user_id = Auth::user()->id;
        else
            $this->user_id = 0;


        if (session()->has('refreshCart'))
        {
            $this->refreshCartFromDB();
            session()->pull('refreshCart');
        }
        else
            $this->loadCartFromSession();

        if (session()->has('shippingAndHandling'))
            $this->shippingAndHandling = session('shippingAndHandling');
        else
            $this->calculateShipping();
    }


    /**
     * Load the cart from the session and return the item array
     *
     * @return array
     */
    public function loadCartFromSession()
    {
        $this->data = session('cart');
        return $this->data;
    }


    /**
     * Get the array of items in the cart
     *
     * @return array
     */
    public function getCartData()
    {
        if ($this->data && !empty($this->data))
            return $this->data;

        return $this->refreshCartFromDB();
    }



    /**
     * Rebuild the session cart from the DB
     */
    public function refreshCartFromDB()
    {
        $data = array();

        if ($this->user_id)
            $carts = Cart::where('user_id', '=', $this->user_id)
                ->orWhere('unique_id', '=', $this->unique_id);
        else
            $carts = Cart::where('unique_id', '=', $this->unique_id);


        foreach ($carts->get() as $cart)
        {
            if ($cart->unique_id != $this->unique_id)
            {
                $cart->unique_id = $this->unique_id;
                $cart->save();
            }

            $data['item-'. $cart->item_id] = [
                'id'            => $cart->item->id,
                'name'          => $cart->item->name,
                'sku'           => $cart->item->product->sku,
                'product_id'    => $cart->item->product_id,
                'price'         => $cart->price,
                'quantity'      => $cart->quantity
            ];
        }

        // Calculate S&H
        // $this->calculateShippingFroMCarts($carts);

        // save to session
        session()->put('cart', $data);

        // save to instance
        $this->data = $data;
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
        if (!isset($this->data))
            $this->refreshCartFromDB();

        $total = 0;

        if ( ! session()->has('cart'))
            return $total;

        $cartItems = session('cart');

        foreach ($cartItems as $cart)
            $total += $cart['price'] * $cart['quantity'];

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

        // dd($item);
        if (session()->has($cartId)){
            $cart = session($cartId);
            session([$cartId => [
                'id'        => $item->id,
                'name'      => $item->name,
                'sku'       => $item->product->sku,
                'product_id'=> $item->product_id,
                'price'     => $item->price,
                'quantity'  => $cart['quantity'] + $quantity
            ]]);
        }
        else{
           session([$cartId => [
               'id'        => $item->id,
               'name'      => $item->name,
                'sku'       => $item->product->sku,
                'product_id'   => $item->product_id,
                'price'     => $item->price,
                'quantity'  => $quantity
            ]]);
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
    protected function addToCartDB(Item $item, $quantity)
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

        // dd(session('country'));

        if (session('country') != "CA")
            $shippingAndHandling = 5;
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

        session(['shippingAndHandling' => $shippingAndHandling]);

        return $this->shippingAndHandling;


        // TODO: Make sure it calculates the letter mail correctly too.

        /*
         * Here is where I could include other factors to ACTUALLY calculate the shipping cost.
         */
    }


    /**
     * Retrieve the cost of shipping and handling
     *
     * @return float
     */
    public function getShippingAndHandling()
    {
        if (!$this->shippingAndHandling)
            return $this->calculateShipping();

        return $this->shippingAndHandling;
    }

    public function isSetRecipientCountry()
    {
        return session()->has('country');
    }

    public function setRecipientCountry($countryCode)
    {
        if ($countryCode == null)
            session()->forget('country');

        session(['country' => $countryCode]);

        $this->calculateShipping();

        return session('country');
    }

    public function getCountryCodeArray()
    {
        return [
            '' => 'Select',
            'CA' => 'Canada',
            'US' => 'United States',
            /*'MX' => 'Mexico',
            'GB' => 'United Kingdom',
            'IE' => 'Ireland',
            'AS' => 'American Samoa',
            'AU' => 'Australia',*/
            // 'GU' => 'Guam',
            // 'UM' => 'United States Outlying Islands',
        ];

    }

    public function getRecipientCountryFull()
    {
        if (session()->has('country'))
        {
            if (session('country') == 'US')
                return 'United States';
            if (session('country') == 'CA')
                return 'Canada';
            return 'International';
        }
    }


    /**
     * Get the total weight of the items in the cart
     *
     * @return int
     */
    public function getTotalWeight()
    {
        $cartData = $this->getCartData();

        // dd ($cartData);
        if (empty($cartData))
            return 0;

        foreach ($cartData as $item)
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
            ->where('unique_id', '=', session('unique_id'))->first();
    }


    /**
     * Completely Empty the cart
     *
     */
    public function clearCart()
    {
        session()->forget('cart');

        $this->clearCartDB();
    }

    /**
     * Empty the cart from the DB
     *
     */
    public function clearCartDB()
    {
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
     * Returns a string used to identify the item in the cart
     *
     * @param $id
     * @return string
     */
    public function getCartIdentifier($id)
    {
        return 'cart.item-'.$id;
    }

    /**
     * Update the cart when the cart page quantities have been changed.
     *
     * @param array $data
     */
    public function updateQuantities(array $data)
    {
        foreach ($data as $cartItem => $quantity)
        {
            $cartItem = explode('-', $cartItem);
            if ($quantity == 0)
            {
                $this->removeByItemId($cartItem[0]);
            }
            else
            {
                if ($cart = $this->getCartByItemId($cartItem[0]))
                {
                    $cart->quantity = $quantity;
                    $cart->save();
                }
            }


        }
        $this->refreshCartFromDB();
        $this->calculateShipping();

    }

    /**
     * Get the Total number of units in the cart
     *
     * @return int
     */
    private function getTotalNumberOfItems()
    {
        $numberOfItems = 0;

        foreach ($this->getCartData() as $item)
            $numberOfItems += $item['quantity'];

        return $numberOfItems;
    }

    /**
     * Get the thickness of the package
     * Returns the thickest object in the cart
     *
     * @return int|mixed
     */
    private function getThickness()
    {
        $cartData = $this->getCartData();

        // dd ($cartData);
        if (empty($cartData))
            return 0;

        foreach ($cartData as $item)
            $productsArray[] = $item['product_id'];

        $products = Product::whereIn('id', $productsArray)->get();;

        $thicknessInMM = 0;
        foreach($products as $product)
            $thicknessInMM = max($thicknessInMM, $product->unit_depth_cm * 10);

        return $thicknessInMM;
    }







    /**
     * Gets the data for the cart from the DB
     * @deprecated use getCartData()
     * @param null $identifier
     * @return array
     */
    public function getCartDataDB($identifier = null)
    {
        return $this->getCartData();
    }


    /**
     * Get the total cost of the cart from the DB
     * @deprecated use getCartTotal()
     * @param null $identifier
     * @return int
     */
    public function getCartTotalDB($identifier = null)
    {
        return $this->getCartTotal();
    }
}



