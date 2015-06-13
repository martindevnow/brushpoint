<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerRequest extends Model {

	public $fillable = [
        'feedback_id',
        'hash',
        'brush_type',

        'request_lot_code',
        'request_address',
        'request_retailer',
        'request_image',
        'request_return',

        'sent_at',
        'received_at',
    ];

}
