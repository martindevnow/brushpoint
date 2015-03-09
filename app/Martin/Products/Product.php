<?php

namespace Martin\Products;


use Martin\Core\CoreModel;

class Product extends CoreModel {

    protected $table = 'products';

    protected $fillable = [
        'name',
        'description',
        'price',
        'sku'
    ];


    public function getBenefitsAttribute($value)
    {
        return unserialize($value);
    }

    public function getFeaturesAttribute($value)
    {
        return unserialize($value);
    }
    public function getOtherListAttribute($value)
    {
        return unserialize($value);
    }




    public function carts()
    {
        return $this->morphMany('Martin\Carts\Cart', 'cartable');
    }

    public function items()
    {
        return $this->hasMany('Martin\Products\Item');
    }
} 