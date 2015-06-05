<?php namespace Martin\Products;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model {

	protected $fillable = [
        'description',
        'quantity',
        'lot_code',
        'expiry_date'
    ];

    public function item()
    {
        return $this->belongsTo('Martin\Product\Item');
    }
}
