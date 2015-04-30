<?php namespace App\Handlers\Events;

use App\Events\ProductWasPurchased;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Martin\Ecom\Payment;

class EmailPurchaseConfirmation {

	/**
	 * Create the event handler.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}

	/**
	 * Handle the event.
	 *
	 * @param  ProductWasPurchased  $event
	 * @return void
	 */
	public function handle(ProductWasPurchased $event)
	{

        $data = [
            'customer_name' => $event->payment->payer->first_name . " " . $event->payment->payer->last_name,
            'customer_email' => $event->payment->payer->email,
            'customer_address' => $event->payment->payer->addresses->first(),

        ];

        Log::info(print_r($event->payment->payer->addresses,1));

		Mail::send('emails.customer.invoice', $data, function($message) use ($event) {
            $message->to('the.one.martin@gmail.com')
                ->subject("BrushPoint: Purchase Receipt");
        });
	}

}
