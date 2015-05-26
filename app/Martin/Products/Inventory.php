<?php namespace Martin\Products;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model {

	protected $fillable = [
        'description',
        'quantity'
    ];

    public function item()
    {
        return $this->belongsTo('Martin\Product\Item');
    }
}
