<?php namespace Martin\Ecom;

use Illuminate\Database\Eloquent\Model;

use Martin\Core\CoreModel;

class Transaction extends CoreModel {


    public function payments()
    {
        return $this->belongsToMany('Martin\Ecom\Payment')->withTimestamps();
    }

    public function soldItems()
    {
        return $this->hasMany('Martin\Ecom\SoldItem');
    }
}
