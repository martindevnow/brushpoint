<?php namespace App\Http\Controllers\Admin;

use App\Commands\SaveAddressToDBCommand;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Martin\Core\Address;
use Martin\Notifications\Flash;

class AddressesController extends Controller {

    public function ajaxStore(Request $request)
    {
        return $this->dispatch(new SaveAddressToDBCommand($request));
    }


    public function delete($address_id)
    {
        $address = Address::find($address_id);
        $address->delete($address_id);

        Flash::message('That address has been deleted.');
        return redirect()->back();
    }


}
