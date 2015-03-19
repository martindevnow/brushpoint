<?php namespace Martin\Ecom;

use Illuminate\Database\Eloquent\Model;

class SoldItem extends Model {

    protected $fillable = [
         'sku',
         'name',
         'price',
         'currency',
         'quantity',
    ];

    public function transaction()
    {
        return $this->belongsTo('Martin\Ecom\Transaction');
    }

    public function item()
    {
        return $this->belongsTo('Martin\Products\Item');
    }

}
