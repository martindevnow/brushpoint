<?php namespace App\Http\Controllers\Admin;

use App\Events\InventoryIncreased;
use App\Events\InventoryPlacedOnHold;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\ReceiveNewInventoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Martin\Ecom\SoldItem;
use Martin\Notifications\Flash;
use Martin\Products\Inventory;
use Martin\Products\Item;

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

        $itemListByIdName = Item::lists('sku', 'id');

        // current levels of all
        return view('admin.inventory.index')
            ->with(compact('inventories', 'itemListByIdName'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

        $itemListByIdName = Item::lists('sku', 'id');

        return view('admin.inventory.create')
            ->with(compact('itemListByIdName'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
	public function store(ReceiveNewInventoryRequest $request)
	{
        Validator::extend('sanitiseDate', function($attribute, $value, $parameters)
        {
            return sanitiseDate($value);
        });

        $validator = Validator::make($request->all(), [
            'expiry_date' => 'sanitiseDate'
        ], ['sanitise_date' => 'Please enter using format: mm/dd/yyyy']);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors()->all());
        }


        // Save
        //dd($request);
        //dd($request);
        $item = Item::findOrFail($request->item_id);


        $inventory = Inventory::create([
            'lot_code' => $request->lot_code,
            'expiry_date' => $request->expiry_date,
            'quantity' => $request->quantity,
            'original_quantity' => $request->quantity,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        $item->inventories()->save($inventory);

        if ($request->status != "on_hold")
            event(new InventoryIncreased($inventory));

        Flash::message("New Inventory added for SKU: " . $item->sku);

        return redirect('admins/inventory');

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
     * Place a lot of inventory on hold
     *
     * @param $intentoryId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function putOnHold($intentoryId)
    {
        $inventory = Inventory::find($intentoryId);

        $inventory->putInventoryOnHold();
        $inventory->save();

        event(new InventoryPlacedOnHold($inventory));

        Flash::message('That lot for that item is now "oh hold"');

        return redirect()->back();
    }

    /**
     * Place a lot of inventory on hold
     *
     * @param $intentoryId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function activate($intentoryId)
    {
        $inventory = Inventory::find($intentoryId);

        $inventory->takeInventoryOffHold();
        $inventory->save();

        event(new InventoryIncreased($inventory));

        Flash::message('That lot for that item is no longer "on hold".');

        return redirect()->back();
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
