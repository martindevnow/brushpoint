<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Martin\Products\ProductRepository;

class PurchaseController extends Controller {

    protected $productsRepository;

    function __construct(ProductRepository $productsRepository)
    {
        $this->productsRepository = $productsRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // This functionality has been disabled.
        return view('purchase.disabled');

        $products = $this->productsRepository->getPurchasePaginated(12);
        return view('purchase.index')->with(['products' => $products]);
    }

    public function retailers()
    {
        return view('purchase.retailers');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $product = $this->productsRepository->getPurchaseById($id);
        $items = $product->items->all(['id', 'variance', 'on_hand']);
        // dd($items);

        // dd($product->images->where('width', 115));
        return view('purchase.show')->with(['product'=> $product, 'items' => $items]);
    }

}
