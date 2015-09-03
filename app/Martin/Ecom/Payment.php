<?php namespace Martin\Ecom;

use App\Events\PackageWasShipped;
use DateTime;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;
use Martin\Core\CoreModel;
use Martin\Core\Traits\RecordsActivity;
use Martin\Reports\Reporter;

class Payment extends CoreModel {

    protected $table = "payments";

    protected $fillable = [
        'shipped',
        'payment_id',
        'state',
        'intent',
        'shipped_at',
        'payer_id',
        'address_id',
        'unique_id',
        'hash',
    ];

    use SoftDeletes;

    use RecordsActivity;

    protected $recordEvents = [
    ];

    protected $drawAttentionEvents = [
        'created', 'updated'
    ];

    use Reporter;

    public $reporterFields = array(
        // payment fields
        'id',            'payment_id',            'intent',            'shipped',            'created_at',
        // payer fields
        'payer.payer_id',       'payer_name',       'payer.email',
        // address fields
        'address.name',         'address.country',  'address.province',
        // transaction fields
        'transactions.firstRecord.amount_total', 'transactions.firstRecord.amount_subtotal', 'transactions.firstRecord.amount_shipping'
    );

    public function setUniqueId()
    {
        $this->unique_id = session('unique_id');
    }


    /**
     * Shipping
     */


    public function toggleShipped($status)
    {
        $this->shipped = $status;
        $dt = new DateTime;
        if ($status)
        {
            $this->shipped_at = $dt->format('y-m-d H:i:s');
            Log::info('payment updated: shipped = true');
            // EVENT WAS MOVED TO THE CONTROLLER
        }
        else
            $this->shipped_at = 0;

        $this->save();
    }



    public function getPayerNameAttribute()
    {
        return $this->payer->first_name . " " . $this->payer->last_name;
    }



    public function getInvoiceNumber()
    {
        return sprintf('%07d', $this->id);
    }


    public function getFullInvoicePath($paymentId = null)
    {
        if ($paymentId)
            $payment = Payment::findOrFail($paymentId);
        else
            $payment = $this;

        return base_path(). '/storage/invoices/BrushPoint_Invoice_'. $payment->getInvoiceNumber() .'.pdf';
    }



    public function buildTransaction(array $itemData)
    {
        dd($itemData);
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


