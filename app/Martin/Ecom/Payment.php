<?php namespace Martin\Ecom;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model {

	protected $table = "payments";


    public function setUniqueId()
    {
        $this->unique_id = session('unique_id');
    }



    /**
     * Relationships
     */

    public function payer()
    {
        return $this->belongsTo('Martin\Ecom\Payer');
    }

    public function transactions()
    {
        return $this->belongsToMany('Martin\Econ\Transaction');
    }
}


