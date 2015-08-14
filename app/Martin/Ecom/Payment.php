<?php namespace Martin\Ecom;

use App\Events\PackageWasShipped;
use DateTime;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Log;
use Martin\Core\CoreModel;
use Martin\Core\Traits\RecordsActivity;

class Payment extends CoreModel {

    use RecordsActivity;

    protected $recordEvents = [

    ];

    protected $drawAttentionEvents = [
        'created', 'updated'
    ];

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
            // create an event
            Log::info('payment updated: shipped = true');
            // EVENT WAS MOVED TO THE CONTROLLER
            event(new PackageWasShipped($this));
            // add an event listener to this event so i can hook in and send a shipment confirmation
        }
        else
            $this->shipped_at = 0;

        $this->save();
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


