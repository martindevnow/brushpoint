<?php namespace Martin\Ecom;

use Illuminate\Database\Eloquent\Model;

use Martin\Core\CoreModel;

class Payer extends CoreModel {

    protected $table = 'payers';

    protected $fillable = [

        // NO PAYMENT_ID 'payment_id',
        // Payer can have many Payments
        'payer_id', 		// string

        'payment_method', 	// string

        'status', 		    // string
        'email', 		    // string

        'first_name', 		// string
        'last_name', 		// string
    ];

    protected $hidden = [];

    public function payments()
    {
        return $this->hasMany('Martin\Ecom\Payment');
    }

}
