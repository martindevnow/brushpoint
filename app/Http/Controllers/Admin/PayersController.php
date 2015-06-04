<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Martin\Ecom\Payer;
use Martin\Ecom\Repositories\PayerRepository;

class PayersController extends Controller {
    /**
     * @var PayerRepository
     */
    private $payerRepository;


    /**
     * @param PayerRepository $payerRepository
     */
    function __construct(PayerRepository $payerRepository)
    {
        $this->middleware('auth');
        $this->payerRepository = $payerRepository;
    }
	/**
	 * Display a listing of the resource.
	 *
	 */
	public function index()
	{
		$payers = Payer::paginate(20);
        $this->layout->context = view('admin.payers.index')
            ->with(compact('payers'));

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 */
	public function show($id)
	{
		$payer = Payer::find($id);

        $this->layout->context = view('admin.payers.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
