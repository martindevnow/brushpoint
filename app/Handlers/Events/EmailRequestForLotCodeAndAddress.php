<?php namespace App\Handlers\Events;

use App\Events\RequestForRetailerInfoIssued;

use DateTime;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Illuminate\Support\Facades\Mail;
use Martin\Quality\Repositories\EmailRepository;

class EmailRequestForLotCodeAndAddress {

    /**
     * @var EmailRepository
     */
    private $emailRepository;

    /**
     * Create the event handler.
     *
     * @param EmailRepository $emailRepository
     * @return \App\Handlers\Events\EmailRequestForLotCodeAndAddress
     */
	public function __construct(EmailRepository $emailRepository)
	{
		//
        $this->emailRepository = $emailRepository;
    }

	/**
	 * Handle the event.
	 *
	 * @param  RequestForRetailerInfoIssued  $event
	 * @return void
	 */
	public function handle(RequestForRetailerInfoIssued $event)
	{
        $this->emailRepository->emailAddressRequest($event->feedback, $event->brushType);
	}

}
