<?php namespace Martin\Ecom;

use Illuminate\Database\Eloquent\Model;

use Martin\Core\CoreModel;
use Martin\Core\Traits\RecordsActivity;

class Payer extends CoreModel {

    use RecordsActivity;

    protected $recordEvents = [];
    protected $drawAttentionEvents = ['created', 'updated'];

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

    public function getName()
    {
        return $this->first_name . " " . $this->last_name;
    }

    public function payments()
    {
        return $this->hasMany('Martin\Ecom\Payment');
    }

}
