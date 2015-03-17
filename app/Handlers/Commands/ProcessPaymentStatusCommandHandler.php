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
        // PAYMENT
        // try to find the payment to see if it is a new payment or what not.

        // IF NEW ---
        // PAYER
        // search for payer (by payer id)
            // create if doesn't exist

        // ADDRESS
        // add address if not completely the same and associate it to the payer
        // an address can only have one payer,
        // but an address can be associated to many payments.
        // need to figure this part out

        // TRANSACTIONS
        // add the transactions and sold items to the DB
        // associate together

        // PAYMENT
        // add the payment to the DB using the payment_id
        // associate the payment to the Payer
        //                              Transactions

        // END IF NEW ---


        /*
         * Payer
         *      Address
         *      Address
         *
         *
         */



        $PPpayment = Payment::get($command->paymentId, $this->api);
        Log::info(print_r($PPpayment,1));

        $paymentRepo = new \Martin\Ecom\Repositories\PaymentRepository();
        $addressRepo = new \Martin\Core\Repositories\AddressRepository();
        $payerRepo = new \Martin\Ecom\Repositories\PayerRepository();



        $payer = $payerRepo->findOrCreateFromPayPal($PPpayment->getPayer());
        $address = $addressRepo->findOrCreateFromPayPal($payer, $PPpayment->get);





        // return $payment;
	}

}
