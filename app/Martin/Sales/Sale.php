<?php


namespace Martin\Sales;


use Martin\Core\CoreModel;

class Sale extends CoreModel {
    protected $table = 'sales';

    protected $fillable = [
        'session_id',
        'stage',
        'cost_subtotal',
        'cost_shipping',
        'shipping_method',
        'cost_tax',
        'cost_total'
    ];

    public function address()
    {
        return $this->belongsTo('Martin\Core\Address');
    }

    public function user()
    {
        return $this->belongsTo('Martin\Users\User');
    }

    public function payer()
    {
        return $this->belongsTo('Martin\Paypal\Payer');
    }

    public function purchases()
    {
        return $this->hasMany('Martin\Sales\Purchase');
    }
} 