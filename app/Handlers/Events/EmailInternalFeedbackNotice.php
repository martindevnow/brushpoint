<?php namespace App\Handlers\Events;

use App\Events\CustomerFeedbackSubmitted;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Illuminate\Support\Facades\Mail;
use Martin\Quality\Repositories\EmailRepository;

class EmailInternalFeedbackNotice {

    /**
     * @var EmailRepository
     */
    private $emailRepository;

    /**
     * Create the event handler.
     *
     * @param EmailRepository $emailRepository
     * @return \App\Handlers\Events\EmailInternalFeedbackNotice
     */
	public function __construct(EmailRepository $emailRepository)
	{
		//
        $this->emailRepository = $emailRepository;
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

        $this->emailRepository->emailInternalFeedbackNotice($feedback, get_class($event));
	}

}
