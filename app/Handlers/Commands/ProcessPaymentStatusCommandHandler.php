<?php namespace App\Handlers\Commands;

use App\Commands\ProcessPaymentStatusCommand;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Martin\Ecom\Checkout;
use PayPal\Api\Payment;

class ProcessPaymentStatusCommandHandler {
    /**
     * @var Checkout
     */
    private $checkout;
    private $api;

    /**
	 * Create the command handler.
	 *
	 * @return void
	 */
	public function __construct(Checkout $checkout)
	{
        $this->checkout = $checkout;
        $this->api = $this->checkout->getApi();
    }

	/**
	 * Handle the command.
	 *
	 * @param  ProcessPaymentStatusCommand  $command
	 * @return void
	 */
	public function handle(ProcessPaymentStatusCommand $command)
	{
        $PPpayment = Payment::get($command->paymentId, $this->api);
        Log::info(print_r($PPpayment,1));

        $paymentRepo = new \Martin\Ecom\Repositories\PaymentRepository();

        $addressRepo = new \Martin\Core\Repositories\AddressRepository();
        $address = $addressRepo->findOrCreateFromPayPal($PPpayment->getPayer());


        $address->save();


        // return $payment;
	}

}
