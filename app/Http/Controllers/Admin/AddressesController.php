<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Martin\Core\Address;
use Martin\Notifications\Flash;

class AddressesController extends Controller {

    public function ajaxStore(Request $request)
    {
        $class = $request->class;
        $model = new $class;

        $model = $model::find($request->addressable_id);

        $address = Address::create([
            'street_1' => $request->street_1,
            'street_2' => $request->street_2,
            'city' => $request->city,
            'province' => $request->province,
            'postal_code' => $request->postal_code,
            'country' => $request->country,
        ]);

        // dd($model);
        $model->addresses()->save($address);


        return view('admin.ajax.singles._address')->with(compact('address'));
    }

    public function delete($address_id)
    {
        $address = Address::find($address_id);
        $address->delete($address_id);

        Flash::message('That address has been deleted.');
        return redirect()->back();
    }


}
