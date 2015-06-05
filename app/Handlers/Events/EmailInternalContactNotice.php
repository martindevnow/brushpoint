<?php namespace App\Handlers\Events;

use App\Events\CustomerContactedUs;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Illuminate\Support\Facades\Mail;

class EmailInternalContactNotice {

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


        Mail::send('emails.internal.contact', compact('contact'), function($message) use ($event) {
            $recipient = 'info@brushpoint.com';


            $message->to($recipient)
                ->subject("BrushPoint: Contact Received: ID: " . $event->contact->id);
            $message->from($event->contact->email, "BrushPoint: Contact");
        });
	}

}
