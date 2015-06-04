<?php namespace App\Events;

use App\Events\Event;

use Illuminate\Queue\SerializesModels;
use Martin\Ecom\Payment;

class PackageWasShipped extends Event {

	use SerializesModels;
    /**
     * @var Payment
     */
    public $payment;

    /**
     * Create a new event instance.
     *
     * @param Payment $payment
     * @return \App\Events\PackageWasShipped
     */
	public function __construct(Payment $payment)
	{
		//
        $this->payment = $payment;
    }

}
