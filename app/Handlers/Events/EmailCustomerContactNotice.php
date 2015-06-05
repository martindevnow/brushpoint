<?php namespace App\Handlers\Events;

use App\Events\CustomerContactedUs;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Illuminate\Support\Facades\Mail;

class EmailCustomerContactNotice {

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
	 * @param  CustomerContactedUs  $event
	 * @return void
	 */
	public function handle(CustomerContactedUs $event)
	{
        $contact = $event->contact;

        Mail::send('emails.customer.contact', compact('contact'), function($message) use ($event) {
            $sender = 'info@brushpoint.com';


            $message->to($event->contact->email)
                ->subject("BrushPoint: Contact Received: ID: " . $event->contact->id);
            $message->from($sender, "BrushPoint: Contact Us");
        });
	}

}
