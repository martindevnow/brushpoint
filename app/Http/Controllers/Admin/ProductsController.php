<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Martin\Notifications\Flash;
use Martin\Products\Product;
use Martin\Products\ProductRepository;

class ProductsController extends Controller {

    protected $productRepository;

    function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
        $this->middleware('auth', ['only' => 'create']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // get all portfolio products
        $products = $this->productRepository->getPaginated(25);

        // return a view
        $this->layout->content = view('admin.products.index')->with(['products'=>$products]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $product = Product::find($id);

        // $products = $this->productRepository->getPortfolioPaginated();

        $this->layout->content =  view('products.show')->with([
            'product' => $product
        ]);
    }

    /**
     * Display the form for adding a new product
     */
    public function create()
    {
        return view('products.create');
    }

    public function store(Requests\CreateProductRequest $request)
    {
        $product = Auth::user()->products()->create($request->all());

        Flash::message('The product has been listed successfully');

        return redirect("admins/products");
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $this->layout->content = view('admin.products.edit')->with(compact('product'));
    }


    public function update($id, Requests\CreateProductRequest $request)
    {

        Product::findOrFail($id)->update($request->all());

        Flash::message('The product has been listed successfully');

        return redirect("admins/products/{$id}");
    }


    public function ajaxActive($productId, Request $request)
    {
        $product = Product::find($productId);
        $product->active = $request->has('active');
        $product->save();
        return "Passed";

    }
    public function ajaxPortfolio($productId, Request $request)
    {
        $product = Product::find($productId);
        $product->portfolio = $request->has('portfolio');
        $product->save();
        return "Passed";

    }
    public function ajaxPurchase($productId, Request $request)
    {
        $product = Product::find($productId);
        $product->purchase = $request->has('purchase');
        $product->save();
        return "Passed";
    }


    protected function ajaxUpdate($productId, $data)
    {
        // The goal was to use the following ...
        /*
         * return $this->ajaxUpdate($productId, ['purchase' => $request->has('purchase')]);
         */
        $product = Product::find($productId);
        $product->update($data);
        dd($product);
        return "Passed";
    }
}
