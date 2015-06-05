<?php namespace App\Handlers\Events;

use App\Events\CustomerFeedbackSubmitted;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Illuminate\Support\Facades\Mail;

class EmailCustomerFeedbackNotice {

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
	 * @param  CustomerFeedbackSubmitted  $event
	 * @return void
	 */
	public function handle(CustomerFeedbackSubmitted $event)
	{
        $feedback = $event->feedback;

        Mail::send('emails.customer.feedback', compact('feedback'), function($message) use ($event) {
            $sender = 'info@brushpoint.com';


            $message->to($event->feedback->email)
                ->subject("BrushPoint: Feedback Received: ID: " . $event->feedback->id);
            $message->from($sender, "BrushPoint: Feedback");
        });
	}

}
