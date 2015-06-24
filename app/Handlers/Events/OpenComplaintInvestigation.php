<?php namespace App\Handlers\Events;

use App\Events\ContactCustomerIssued;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Illuminate\Support\Facades\Auth;
use Martin\Quality\Investigation;

class OpenComplaintInvestigation {

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
	 * @param  ContactCustomerIssued  $event
	 * @return void
	 */
	public function handle(ContactCustomerIssued $event)
    {
        // only open an investigation if 'request_field_sample'

        $customerRequest = $event->customerRequest;
        if ($customerRequest->request_field_sample)
        {
            // open an investigation on the feedback
            $investigation = new Investigation();
            // dd(get_current_time());

            $investigation->field_sample_requested_at = get_current_time();
            $investigation->save();

            Auth::user()->investigations()->save($investigation);
            $event->feedback->investigations()->save($investigation);

        }
	}

}
