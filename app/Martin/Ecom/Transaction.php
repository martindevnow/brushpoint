<?php namespace Martin\Ecom;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Martin\Core\CoreModel;

class Transaction extends CoreModel {

    use SoftDeletes;

    protected $fillable = [
        'amount_subtotal',
        'amount_shipping',
        'amount_shipping_real',
        'amount_total',
        'amount_currency',
        'description',
    ];


    public function payments()
    {
        return $this->belongsToMany('Martin\Ecom\Payment')->withTimestamps();
    }

    public function soldItems()
    {
        return $this->hasMany('Martin\Ecom\SoldItem');
    }
}
