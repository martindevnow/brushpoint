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




    public $reporterFields = array(
        'id',
        // transaction fields
        'transaction.id',

        // payment fields
        'transaction.payments.firstRecord.payment_id',
        'transaction.payments.firstRecord.state',
        'transaction.payments.firstRecord.intent',
        'transaction.payments.firstRecord.created_at',
        'transaction.payments.firstRecord.shipped',
        'transaction.payments.firstRecord.shipped_at',

        // item fields
        'item.sku',

        // sold item fields
        'lot_code', 'name', 'price', 'quantity',
    );


    public function transaction()
    {
        return $this->belongsTo('Martin\Ecom\Transaction');
    }

    public function item()
    {
        return $this->belongsTo('Martin\Products\Item');
    }

}
