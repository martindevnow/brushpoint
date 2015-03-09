<?php


namespace Martin\Products;


use Martin\Core\CoreModel;

class Item extends CoreModel {
    protected $table = 'items';

    protected $fillable = [
        'name',
        'description',
        'sku',
        'price',
        'on_hand'
    ];

    public function product()
    {
        return $this->belongsTo('Martin\Products\Product');
    }

    public function purchases()
    {
        return $this->hasMany('Martin\Sales\Purchase');
    }


    public function carts()
    {
        return $this->morphMany('Martin\Products\Cart', 'cartable');
    }

} 