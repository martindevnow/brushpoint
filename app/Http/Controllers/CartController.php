<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Martin\Notifications\Flash;
use Martin\Products\CartRepository;
use Martin\Products\Item;
use Martin\Products\Product;

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

    public function confirmAddToCart($id)
    {
        $product = Product::find($id);
        $cart = $this->cartRepository->getCartByProductId($id);

        $selections = array();
        if ($product->items()->count())
        {
            foreach($product->items()->get() as $item)
            {
                $selections[$item->id] = $item->name;
            }
        }

        return view('cart.confirmAdd')->with(['product' => $product,
                                                    'cart' => $cart,
                                                    'selections' => $selections]);

    }

    public function addToCartConfirmed($product_id, Request $request)
    {
        // $input = Input::all();
        $fields = $request->only(['item_id', 'quantity']);
        //  dd($fields);

        //fetch the item
        $item = Item::find($fields['item_id']);

        $success = $this->cartRepository->addToCart($item, $fields['quantity']);

        if ($success)
        {
            Flash::message('It has been added to your cart.');
            return redirect('/purchase/id-'. $product_id);
        }
        else
        {
            Flash::error('There was an error');
            return redirect()->back()->withInput();
        }


    }


}
