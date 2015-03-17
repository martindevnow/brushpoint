<?php namespace Martin\Ecom;

use Illuminate\Database\Eloquent\Model;

use Martin\Core\CoreModel;

class Transaction extends CoreModel {


    public function payment()
    {
        return $this->belongsToMany('Martin\Ecom\Payment');
    }

    public function soldItems()
    {
        return $this->hasMany('Martin\Ecom\SoldItem');
    }
}
