<?php namespace Martin\Ecom;

use Illuminate\Database\Eloquent\Model;

use Martin\Core\CoreModel;

class Payer extends CoreModel {

    protected $table = 'payers';

    protected $fillable = [

        // NO PAYMENT_ID 'payment_id',
        // Payer can have many Payments

        'payment_method', 	// string
        'status', 		// string
        'funding_option_id', 	// string

        'email', 				// string
        'external_remember_me_id', 	// string
        'buyer_account_number', 		// string
        'first_name', 		// string
        'last_name', 		// string
        'payer_id', 		// string
        'phone', 			// string
        'phone_type', 		// string
        'birth_date', 		// string
        'tax_id', 		    // string
        'tax_id_type',

        // NO 'shipping_address_id' or 'billing_address'
        // Payer can have many addresses
    ];

    protected $hidden = [];

    public function payments()
    {
        return $this->hasMany('Martin\Ecom\Payment');
    }
	//

}
