<?php namespace App\Handlers\Commands;

use App\Commands\SaveAddressToDBCommand;

use Illuminate\Queue\InteractsWithQueue;
use Martin\Core\Address;

class SaveAddressToDBCommandHandler {

    public $request;
	/**
	 * Create the command handler.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}

	/**
	 * Handle the command.
	 *
	 * @param  SaveAddressToDBCommand  $command
	 * @return void
	 */
	public function handle(SaveAddressToDBCommand $command)
	{
        $this->request = $command->request;

        $class = $this->request->class;
        $model = new $class;

        $model = $model::find($this->request->addressable_id);

        $address = Address::create([
            'street_1' => $this->request->street_1,
            'street_2' => $this->request->street_2,
            'city' => $this->request->city,
            'province' => $this->request->province,
            'postal_code' => $this->request->postal_code,
            'country' => $this->request->country,
        ]);

        // dd($model);
        $model->addresses()->save($address);


        return view('admin.ajax.singles._address')->with(compact('address'));

	}

}
