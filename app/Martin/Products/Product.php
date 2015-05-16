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

    public function getBenefits()
    {
        $benefits = $this->benefits;
        return $this->virtuesToArray($benefits);
    }

    public function getFeatures()
    {
        $features = $this->features;
        return $this->virtuesToArray($features);
    }

    public function getOthers()
    {
        $others = $this->others;
        return $this->virtuesToArray($others);
    }




    private function virtuesToString($virtues)
    {
        $result = "";
        foreach($virtues as $virtue)
            $result .= "\r" . $virtue->body;
        return $result;
    }

    private function virtuesToArray($virtues)
    {
        $result = [];
        foreach($virtues as $virtue)
            $result [] = $virtue->body;
        return $result;
    }


    public function benefits()
    {
        return $this->virtues()->where('type', 'benefit');
    }

    public function features()
    {
        return $this->virtues()->where('type', 'feature');
    }

    public function others()
    {
        return $this->virtues()->where('type', 'other');
    }




    
    public function carts()
    {
        return $this->morphMany('Martin\Carts\Cart', 'cartable');
    }

    public function items()
    {
        return $this->hasMany('Martin\Products\Item');
    }

    public function virtues()
    {
        return $this->hasMany('Martin\Products\Virtue');
    }
} 