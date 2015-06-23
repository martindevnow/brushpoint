<?php

namespace Martin\Products;


use Martin\Core\CoreModel;

class Product extends CoreModel {

    protected $table = 'products';

    protected $fillable = [
        'name',
        'description',
        'price',
        'sku',
        'unit_weight_g',
        'unit_depth_cm',
        'pack_size',
        'pack_description',
    ];



    public function scopeActive($query)
    {
        return $query->where('active', '=', 1);
    }
    public function scopePurchase($query)
    {
        return $query->where('purchase', '=', 1);
    }
    public function scopePortfolio($query)
    {
        return $query->where('portfolio', '=', 1);
    }

    public function urlToProductPage()
    {
        return '/products/id-'. $this->id;
    }

    public function getProductInventory()
    {
        $query = $this->items
            ->sum('on_hand');
        return $query;
    }



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
        return $this->virtues()->where('type', 'benefit')->orderBy('priority', 'ASC');
    }

    public function features()
    {
        return $this->virtues()->where('type', 'feature')->orderBy('priority', 'ASC');
    }

    public function others()
    {
        return $this->virtues()->where('type', 'other')->orderBy('priority', 'ASC');
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