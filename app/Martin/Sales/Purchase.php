<?php


namespace Martin\Sales;


use Martin\Core\CoreModel;

class Purchase extends CoreModel {
    protected $table = 'purchases';

    protected $fillable = [
        'price'
    ];

    public function user()
    {
        return $this->belongsTo('Martin\Users\User');
    }

    public function sale()
    {
        return $this->belongsTo('Martin\Sales\Sale');
    }

    public function item()
    {
        return $this->belongsTo('Martin\Products\Item');
    }

} 