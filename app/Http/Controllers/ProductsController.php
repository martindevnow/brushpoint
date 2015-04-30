<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Martin\Notifications\Flash;
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
        $products = $this->productRepository->getPortfolioPaginated(25);

        // return a view
        return view('products.index')->with(['products'=>$products]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $product = $this->productRepository->getPortfolioById($id);
        
        $products = $this->productRepository->getPortfolioPaginated();

        return view('products.show')->with([
            'products' => $products,
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


        return redirect("administration");
    }

}
