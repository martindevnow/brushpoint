<?php namespace App\Handlers\Events;

use App\Events\ProductWasPurchased;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Illuminate\Support\Facades\Mail;

class EmailPurchaseNotificationToStaff {

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
        $payment = $event->payment;
        $payer = $payment->payer;
        $address = $payment->address; // can have different recipient
        $transactions = $payment->transactions->all(); // array of transactions

        $data = compact('payment', 'payer', 'address', 'transactions');
        /// Log::info(print_r($event->payment->payer->addresses,1));

        Mail::send('emails.internal.purchased', $data, function($message) use ($event) {
            $message->to('benjaminm@brushpoint.com')
                ->subject("BrushPoint: Order Received" . $event->payment->id);
            $message->from('orders@brushpoint.com', 'BrushPoint Orders');
        });
	}

}
