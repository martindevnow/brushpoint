<?php

namespace Martin\Products;


use Illuminate\Support\Facades\Auth;
use Session;

// use Illuminate\Support\Facades\Session;

class CartRepository {

    public $user_id;
    public $unique_id;

    function __construct()
    {
        $this->unique_id = Session::get('unique_id');
        if (Auth::user())
            $this->user_id = Auth::user()->id;
        else
            $this->user_id = 0;
    }

    public function getCartData()
    {
        $data = array();

        if (Session::has('cart'))
        {
            $carts = Session::get('cart');

            foreach ($carts as $id => $cart)
            {
                $data[] = [
                    'id'        => str_replace('item-', '', $id),
                    'name'      => $cart['name'],
                    'price'     => $cart['price'],
                    'quantity'  => $cart['quantity']
                ];
            }
        }
        else {
            return array();
        }
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
            $carts = Cart::where('unique_id', '=', $this->unique_id)
                ->orWhere('user_id', '=', $this->user_id);

        foreach ($carts->get() as $cart)
        {
            $data[] = [
                'id'        => $cart->cartable_id,
                'name'      => $cart->cartable->name,
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
        // dd($item);
        $cartId = 'cart.item-'.$item->id;

        // update session first
        if (Session::has($cartId)){
            $cart = Session::get($cartId);
            Session::put($cartId, [
                'name' => $item->name,
                'price' => $item->price,
                'quantity' => $cart['quantity'] + $quantity
            ]);
        }
        else{
            Session::put($cartId, [
                'name' => $item->name,
                'price' => $item->price,
                'quantity' => $quantity
            ]);
        }

        $cart = $this->addToCartDB($item, $quantity);

        return $cart;
    }

    public function addToCartDB(Item $item, $quantity)
    {
        $cart = Cart::where('unique_id', '=', $this->unique_id)
            ->where('cartable_id', '=', $item->id)->get();

        if (!$cart->count())
        {
            $cart = new Cart();

            $cart->unique_id = $this->unique_id;
            $cart->user_id = $this->user_id;
            $cart->quantity = $quantity;
            $cart->price = $item->price;
            $cart->save();

            $item->carts()->save($cart);
        }
        else{

            $cart = $cart->first();
            $cart->quantity = $cart->quantity + $quantity;
            $cart->save();
        }

        return $cart;

    }

    public function getCartByProductId($id)
    {
        return Cart::where('cartable_id', '=', $id)->where('unique_id', '=', Session::get('unique_id'));
    }


    public function clearCart($identifier = null)
    {
        if (!$identifier)
            Session::forget('cart');

        $this->clearCartDB($identifier);
    }

    public function clearCartDB($identifier = null)
    {
        if ($identifier)
            Cart::where('unique_id', '=', $identifier)->orWhere('user_id', '=', $identifier)->delete();
        else
            Cart::where('unique_id', '=', $this->unique_id)->orWhere('user_id', '=', $this->user_id)->delete();
    }
}



