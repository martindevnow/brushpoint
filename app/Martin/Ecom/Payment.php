<?php namespace Martin\Ecom;

use Illuminate\Database\Eloquent\Model;

use Martin\Core\CoreModel;

class Payment extends CoreModel {

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
        return $this->belongsToMany('Martin\Ecom\Transaction')->withTimestamps();
    }

    public function address()
    {
        return $this->belongsTo('Martin\Core\Address');
    }
}


