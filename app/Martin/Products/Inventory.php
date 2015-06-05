<?php namespace Martin\Products;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model {

	protected $fillable = [
        'transaction_id',
        'item_id',

        'lot_code',
        'expiry_date',

        'description',

        'quantity',
    ];



    public function scopeActive($query)
    {
        return $query->where('description', '!=', 'on_hold');
    }

    public function item()
    {
        return $this->belongsTo('Martin\Product\Item');
    }
}
