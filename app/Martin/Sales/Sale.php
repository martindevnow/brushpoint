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

    public function setSessionId()
    {
        $this->session_id = session('unique_id');
        return $this->session_id;
    }

    public function setTotalCost($cost)
    {
        $this->cost_total = $cost;
    }


    public function setTaxCost($cost)
    {
        $this->cost_tax = $cost;
    }

    public function setSubtotalCost($cost)
    {
        $this->cost_subtotal = $cost;
    }

    public function setShippingCost($cost)
    {
        $this->cost_shipping = $cost;
    }

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