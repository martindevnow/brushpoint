<?php namespace Martin\Products;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Martin\Core\Traits\RecordsActivity;

class Inventory extends Model {

    use SoftDeletes;
    use RecordsActivity;

	protected $fillable = [
        'transaction_id',
        'item_id',

        'lot_code',
        'expiry_date',

        'description',

        'quantity',
        'original_quantity',
        'status'
    ];


    public function isActive()
    {
        if ($this->status != "on_hold")
            return true;
    }



    public function updateField($field, $value)
    {
        $this->$field = $value;
        $this->save();
        return $this;
    }


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
