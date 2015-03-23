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

    public function getBenefitsText()
    {
        if (!$this->benefits)
            return "";
        return implode("\r", $this->benefits);
    }

    public function getFeaturesText()
    {
        if (! $this->features)
            return "";
        return implode("\r", $this->features);
    }

    public function getOtherListText()
    {

        return implode("\r", $this->other_list);
    }


    public function getBenefitsAttribute($value)
    {
        if (! $value)
            return [];
        return unserialize($value);
    }

    public function getFeaturesAttribute($value)
    {
        if (! $value)
            return [];
        return unserialize($value);
    }

    public function getOtherListAttribute($value)
    {
        if (! $value)
            return [];
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