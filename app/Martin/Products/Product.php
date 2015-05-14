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
        $benefits = $this->benefits;
        return $this->virtuesToString($benefits);
    }

    public function getFeaturesText()
    {
        $features = $this->features;
        return $this->virtuesToString($features);
    }

    public function getOtherListText()
    {
        $others = $this->others;
        return $this->virtuesToString($others);
    }




    private function virtuesToString($virtues)
    {
        $result = "";
        foreach($virtues as $virtue)
            $result .= "\r" . $virtue->body;
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