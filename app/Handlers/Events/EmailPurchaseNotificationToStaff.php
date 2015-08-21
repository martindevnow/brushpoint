<?php namespace App\Handlers\Events;

use App\Events\ProductWasPurchased;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Illuminate\Support\Facades\Mail;
use Martin\Quality\Repositories\EmailRepository;

class EmailPurchaseNotificationToStaff {

    /**
     * @var EmailRepository
     */
    private $emailRepository;

    /**
     * Create the event handler.
     *
     * @param EmailRepository $emailRepository
     * @return \App\Handlers\Events\EmailPurchaseNotificationToStaff
     */
	public function __construct(EmailRepository $emailRepository)
	{
		//
        $this->emailRepository = $emailRepository;
    }

	/**
	 * Handle the event.
	 *
	 * @param  ProductWasPurchased  $event
	 * @return void
	 */
	public function handle(ProductWasPurchased $event)
	{
        $type = get_class($event);
        $payment = $event->payment;

        $this->emailRepository->emailInternalPurchaseNotice($payment, $type);
	}
}
