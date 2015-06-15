<?php namespace App\Handlers\Events;

use App\Events\ContactCustomerIssued;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

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
        if ($customerRequest->request_return)
        {
            // open an investigation on the feedback
            $investigation = new Investigation();
            $investigation->field_sample_request_at->
        }
	}

}
