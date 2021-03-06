<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Martin\Notifications\Flash;
use Martin\Products\Product;
use Martin\Products\ProductRepository;
use Martin\Products\Virtue;

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

        $product = $this->productRepository->updateProduct($id, $request->all());

        // Product::findOrFail($id)->update($request->all());

        Flash::message('The product has been listed successfully');

        return redirect("admins/products/{$id}");
    }


    public function ajaxPatch($productId, Request $request)
    {
        $field = $request->get('field');
        $value = $request->has($field);

        $product = Product::find($productId);
        $product->$field = $value;
        $product->save();
        return "Passed";
    }

    public function ajaxSaveListOrder (Request $request)
    {
        // dd($request->all());

        foreach($request->virtue as $priority => $virtue_id)
        {
            $virtue = Virtue::find($virtue_id);
            // dd($virtue);
            $virtue->priority = $priority;
            $virtue->save();
        }
        return 1;
    }

    public function rearrange()
    {
        $products = Product::active()->portfolio()->get();
        $numCols = 4;
        $this->layout->content = view('admin.products.rearrange')->with(compact('products', 'numCols'));
    }

    public function rearrangePurchase()
    {
        $products = Product::active()->purchase()->get();
        $numCols = 3;
        $this->layout->content = view('admin.products.rearrange')->with(compact('products', 'numCols'));
    }


    public function ajaxSaveProductOrder (Request $request)
    {
        // dd($request->all());

        foreach($request->product as $priority => $product_id)
        {
            $product = Product::find($product_id);
            $product->display_order = $priority;
            $product->save();
        }
        return 1;
    }

}
