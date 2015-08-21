<?php namespace App\Handlers\Events;

use App\Events\ProductWasPurchased;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Martin\Ecom\Payment;
use Martin\Quality\Repositories\EmailRepository;

class EmailPurchaseConfirmation {

    /**
     * @var EmailRepository
     */
    private $emailRepository;

    /**
     * Create the event handler.
     *
     * @param EmailRepository $emailRepository
     * @return \App\Handlers\Events\EmailPurchaseConfirmation
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
        $payment = $event->payment;

        $this->emailRepository->emailCustomerPurchaseNotice($payment);
    }

}
