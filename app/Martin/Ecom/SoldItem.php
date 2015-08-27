<?php namespace Martin\Ecom;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Martin\Reports\Reporter;

class SoldItem extends Model {

    use SoftDeletes;

    use Reporter;

    protected $fillable = [
        'sku',
        'name',
        'price',
        'currency',
        'quantity',
        'lot_code',

        'item_id',
        'transaction_id',

    ];

    public function transaction()
    {
        return $this->belongsTo('Martin\Ecom\Transaction');
    }

    public function item()
    {
        return $this->belongsTo('Martin\Products\Item');
    }

}
