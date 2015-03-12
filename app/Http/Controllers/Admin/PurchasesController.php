<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Martin\Products\ProductRepository;

class PurchasesController extends Controller {

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

        return view('admin.purchases.index');
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
        return view('purchase.show')->with(['product'=> $product]);
    }

}
