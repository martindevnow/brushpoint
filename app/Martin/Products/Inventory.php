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
        'original_quantity',
    ];



    public function scopeActive($query)
    {
        return $query->where('status', '!=', 'on_hold');
    }

    public function item()
    {
        return $this->belongsTo('Martin\Products\Item');
    }

    public function putInventoryOnHold()
    {
        $this->status = "on_hold";
    }

    public function takeInventoryOffHold()
    {
        $this->status = "available";
    }

    public function isOnHold()
    {
        return $this->status == "on_hold";
    }

}
