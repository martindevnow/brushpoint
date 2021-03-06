<?php namespace App\Handlers\Events;

use App\Events\ProductWasPurchased;

use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Illuminate\Support\Facades\Log;
use Martin\Core\Pdf;
use Martin\Ecom\Repositories\PaymentRepository;
// use mikehaertl\wkhtmlto\Pdf;

class GenerateInvoicePdf {


    /**
     * @var PaymentRepository
     */
    private $paymentRepository;

    /**
     * Create the event handler.
     *
     * @param PaymentRepository $paymentRepository
     * @return \App\Handlers\Events\GenerateInvoicePdf
     */
	public function __construct(PaymentRepository $paymentRepository)
	{
        $this->paymentRepository = $paymentRepository;
    }

	/**
	 * Handle the event.
	 *
	 * @param  ProductWasPurchased  $event
	 * @return void
	 */
	public function handle(ProductWasPurchased $event)
	{
        $paymentId = $event->payment->id;

        $this->paymentRepository->generateInvoice($paymentId);

	}

}
