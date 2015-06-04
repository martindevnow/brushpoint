<?php namespace App\Handlers\Events;

use App\Events\PackageWasShipped;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EmailShippingConfirmation {

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
	 * @param  PackageWasShipped  $event
	 * @return void
	 */
	public function handle(PackageWasShipped $event)
	{

        Log::info('Sending Email of Shipment Confirmation...');

        $payment = $event->payment;
        $payer = $payment->payer;
        Log::info($payer);
        $address = $payment->address; // can have different recipient
        $transactions = $payment->transactions->all(); // array of transactions

        $data = compact('payment', 'payer', 'address', 'transactions');
        /// Log::info(print_r($event->payment->payer->addresses,1));

        Mail::send('emails.customer.asn', $data, function($message) use ($event) {
            $message->to($event->payment->payer->email)
                ->subject("BrushPoint: Shipping Confirmation");
            $message->from('shipping@brushpoint.com', 'BrushPoint Shipping');
        });
	}

}
