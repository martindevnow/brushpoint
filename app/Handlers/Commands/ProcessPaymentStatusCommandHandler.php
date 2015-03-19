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
        $PPpayment = Payment::get($command->paymentId, $this->api);
        Log::info(print_r($PPpayment,1));

        $paymentRepo = new \Martin\Ecom\Repositories\PaymentRepository();
        $ecomPayment = $paymentRepo->findOrCreateFromPaypal($PPpayment);

        if ($ecomPayment->state == "created" || $ecomPayment->state == "approved")
        {
            // this payment already exists for some reason
            // FLAG
            // TODO: Flag this payment


            //           dd("This payment was already recorded");
        }

        $ecomPayment->state = $PPpayment->getState();
        $ecomPayment->intent = $PPpayment->getIntent();
        $ecomPayment->save();



        // IF NEW ---
        // PAYER
        // search for payer (by payer id)
            // create if doesn't exist
        if (! $ecomPayment->payer)
        {
            $payerRepo = new \Martin\Ecom\Repositories\PayerRepository();
            $ecomPayer = $payerRepo->findOrCreateFromPayPal($PPpayment->getPayer());

            // dd($ecomPayment->payer());
            $ecomPayer->payments()->save($ecomPayment);
        }
        else
        {
            $ecomPayer = $ecomPayment->payer;
        }


        // ADDRESS
        // add address if not completely the same and associate it to the payment
        // an address can only have one payer,
        // but an address can be associated to many payments.
        // need to figure this part out
        // dd($ecomPayment->addresses);
        if ( !$ecomPayment->addresses->count() )
        {
            // dd('add new address');
            $addressRepo = new \Martin\Core\Repositories\AddressRepository();
            $ecomAddress = $addressRepo->createFromPayPal($ecomPayer, $PPpayment);

            /*
            if (! $ecomPayer->addresses()->where('id', $ecomAddress->id)->first())
            {
                // the id of this address is not associated to this user.
                $ecomPayer->addresses()->save($ecomAddress);
            }*/
            $ecomPayment->addresses()->save($ecomAddress);
        }
        // dd('already has an address');


        // TRANSACTIONS
        $transRepo = new \Martin\Ecom\Repositories\TransactionRepository();
        $ecomTransactions = $transRepo->createFromPaypal($PPpayment, $ecomPayment);


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







        // return $payment;
	}

}
