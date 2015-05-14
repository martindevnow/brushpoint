<?php namespace Martin\Products;

use Martin\Core\CoreModel;

class Virtue extends CoreModel {

    protected $table = 'virtues';

    protected $fillable = [
        'body',
        'type'
    ];


    public function product()
    {
        return $this->belongsTo('Martin\Products\Product');
    }
}
