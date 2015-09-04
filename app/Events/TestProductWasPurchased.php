<?php namespace App\Events;

use App\Events\Event;

use Illuminate\Queue\SerializesModels;
use Martin\Ecom\Payment;

class TestProductWasPurchased extends Event {
    use SerializesModels;
    /**
     * @var Payment
     */
    public $payment;

    /**
     * Create a new event instance.
     *
     * @param Payment $payment
     * @return \App\Events\ProductWasPurchased
     */
    public function __construct(Payment $payment)
    {
        //
        $this->payment = $payment;
    }

}
