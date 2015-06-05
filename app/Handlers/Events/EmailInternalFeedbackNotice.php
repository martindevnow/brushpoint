<?php namespace App\Handlers\Events;

use App\Events\CustomerFeedbackSubmitted;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Illuminate\Support\Facades\Mail;

class EmailInternalFeedbackNotice {

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


        Mail::send('emails.internal.feedback', compact('feedback'), function($message) use ($event) {
            $recipient = 'info@brushpoint.com';


            $message->to($recipient)
                ->subject("BrushPoint: Feedback Received: ID: " . $event->feedback->id);
            $message->from($event->feedback->email, "BrushPoint: Feedback");
        });
	}

}
