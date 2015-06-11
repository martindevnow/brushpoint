<?php namespace App\Handlers\Events;

use App\Events\ContactCustomerIssued;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Martin\Quality\Repositories\EmailRepository;

class SendContactToCustomer {

    /**
     * @var EmailRepository
     */
    public $emailRepository;

    /**
     * Create the event handler.
     *
     * @param EmailRepository $emailRepository
     * @return \App\Handlers\Events\SendContactToCustomer
     */
	public function __construct(EmailRepository $emailRepository)
	{
		//
        $this->emailRepository = $emailRepository;
    }

	/**
	 * Handle the event.
	 *
	 * @param  ContactCustomerIssued  $event
	 * @return void
	 */
	public function handle(ContactCustomerIssued $event)
	{
        $this->emailRepository->emailCustomer($event->feedback, $event->contact);

    }

}
