<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\SetPayerInfoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Martin\Notifications\Flash;
use Martin\Products\CartRepository;
use Martin\Products\Product;
use Martin\Products\Item;
// use Martin\Sales\Sale;



class CartController extends Controller {

    protected $cartRepository;

    function __construct(CartRepository $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // show the contents of the cart
        return view('cart.index');

    }

    /**
     * Show a form to force the user to seelct the variance they desire and confirm
     *
     * @param $id
     * @return $this
     */
    public function confirmAddToCart($id)
    {
        $product = Product::find($id);
        $cart = $this->cartRepository->getCartByItemId($id);


        // dd($product->items[0]);

        $selections = array();
        if ($product->items()->count())
            $selections = $product->items()->lists('variance', 'id');

        return view('cart.confirmAdd')->with(['product' => $product,
                                                    'cart' => $cart,
                                                    'selections' => $selections]);

    }

    /**
     * Add the item to the cart based on the user's selection and confirmation
     *
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function addToCartConfirmed(Request $request)
    {
        $fields = $request->only(['item_id', 'quantity']);

        $item = Item::find($fields['item_id']);

        $success = $this->cartRepository->addToCart($item, $fields['quantity']);

        if ($success)
        {
            Flash::message('It has been added to your cart.');
            return redirect('/cart');
        }
        else
        {
            Flash::error('There was an error');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove an item from the user's cart by Item->id
     *
     * @param $itemId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove($itemId)
    {
        $this->cartRepository->removeByItemId($itemId);

        Flash::message('Successfully removed from cart.');

        return redirect()->back();
    }

    /**
     * Update the quantites of the cart.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $this->cartRepository->updateQuantities($request->except('_token'));

        Flash::message('Quantities have been updated');

        return redirect()->back();
    }


}
