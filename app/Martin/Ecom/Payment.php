<?php namespace Martin\Ecom;

use DateTime;
use Illuminate\Database\Eloquent\Model;

use Martin\Core\CoreModel;

class Payment extends CoreModel {

	protected $table = "payments";

    protected $fillable = [
        'shipped',
        'payment_id',
        'state',
        'intent',
        'shipped_at',
        'payer_id',
        'address_id'
    ];


    public function setUniqueId()
    {
        $this->unique_id = session('unique_id');
    }

    public function toggleShipped($status)
    {
        // $status = ($this->closed + 1) % 2;
        $this->shipped = $status;
        $dt = new DateTime;
        if ($status)
            $this->shipped_at = $dt->format('y-m-d H:i:s');
        else
            $this->shipped_at = 0;
        $this->save();
    }

    /**
     * Relationships
     */

    public function payer()
    {
        return $this->belongsTo('Martin\Ecom\Payer');
    }

    public function transactions()
    {
        return $this->belongsToMany('Martin\Ecom\Transaction')->withTimestamps();
    }

    public function address()
    {
        return $this->belongsTo('Martin\Core\Address');
    }
}


