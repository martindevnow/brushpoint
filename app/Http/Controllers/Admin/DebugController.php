<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Martin\Notifications\Flash;
use Martin\Products\Item;

class DebugController extends Controller {


	/**
	 * Display a listing debug tools
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('admin.debug.index');
	}

    /**
     * Calculate the current on hand inventory for all items.
     *
     * @return Response
     */
    public function calculateInventory()
    {
        $items = Item::all();

        foreach ($items as $item)
            $item->refreshOnHand();

        Flash::message('Items updated successfully.');

        return redirect()->back();
    }


}
