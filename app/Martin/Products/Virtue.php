<?php namespace Martin\Products;

use Martin\Core\CoreModel;
use Martin\Core\Traits\RecordsActivity;

class Virtue extends CoreModel {

    use RecordsActivity;

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
