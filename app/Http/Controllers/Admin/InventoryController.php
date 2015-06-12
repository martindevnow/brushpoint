<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Martin\Ecom\SoldItem;
use Martin\Products\Inventory;

class InventoryController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        // display overview of inventory
        $inventories = Inventory::orderBy('item_id')->paginate(25);

        // current levels of all
        return view('admin.inventory.index')->with(compact('inventories'));
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
	 * @return Response
	 */
	public function show($id)
	{

	}

    /**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function showItem($id)
	{
        $inventories = Inventory::where('item_id', '=', $id)->paginate(25);

        return view('admin.inventory.showItem')
            ->with(compact('inventories'));
	}


    /**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function showLotActivity($id)
	{
        $inventory = Inventory::find($id);

        $soldItems = SoldItem::where('lot_code', '=', $inventory->lot_code)
            ->where('item_id', '=', $inventory->item_id)->get();


        return view('admin.inventory.showLotActivity')
            ->with(compact('inventory', 'soldItems'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{


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
