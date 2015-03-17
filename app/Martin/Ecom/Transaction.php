<?php namespace Martin\Ecom;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model {



    public function payment()
    {
        return $this->belongsToMany('Martin\Ecom\Payment');
    }


}
