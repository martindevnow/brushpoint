<?php namespace App\Handlers\Events;

use App\Events\ProductWasPurchased;

use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Martin\Core\Pdf;
use Martin\Ecom\Repositories\PaymentRepository;
// use mikehaertl\wkhtmlto\Pdf;

class GenerateInvoicePdf implements SelfHandling{

    use SelfHandling;

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

        $pdfPath = $this->paymentRepository->getInvoicePath($paymentId);

        // You can pass a filename, a HTML string or an URL to the constructor
        $pdf = new Pdf(url('/') . "/admins/payments/invoice/html/". $paymentId);

        $saved = $pdf->saveAs($pdfPath);

        if (!$saved)
            dd($pdf->getError());
	}

}
