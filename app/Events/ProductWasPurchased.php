<?php namespace App\Events;

use App\Events\Event;

use Illuminate\Queue\SerializesModels;
use Martin\Ecom\Payment;

class ProductWasPurchased extends Event {

	use SerializesModels;
    /**
     * @var Payment
     */
    public $payment;

    /**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct(Payment $payment)
	{
		//
        $this->payment = $payment;
    }

}
