<?php namespace App\Handlers\Events;

use App\Events\RequestForRetailerInfoIssued;

use DateTime;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Illuminate\Support\Facades\Mail;

class EmailRequestForLotCodeAndAddress {

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
	 * @param  RequestForRetailerInfoIssued  $event
	 * @return void
	 */
	public function handle(RequestForRetailerInfoIssued $event)
	{
		$feedback = $event->feedback;

        if ($event->brushType == "battery")
            $emailTemplate = "lotCodeRequestBattery";
        else
            $emailTemplate = "lotCodeRequestRechargeable";

        Mail::send('emails.customer.'. $emailTemplate, compact('feedback'), function ($message) use ($event) {
            $sender = 'info@brushpoint.com';

            $message->to($event->feedback->email)
                ->subject('BrushPoint: Followup on Feedback ID: '. $event->feedback->id);
            $message->from($sender, 'BrushPoint Feedback');
        });

        // Set requested at time.
        $dt = new DateTime;
        $feedback->address_requested_at = $dt->format('y-m-d H:i:s');
        $feedback->save();
	}

}
