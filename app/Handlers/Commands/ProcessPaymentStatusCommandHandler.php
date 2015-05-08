<?php namespace App\Handlers\Commands;

use App\Commands\ProcessPaymentStatusCommand;

use App\Exceptions\PaymentAlreadyProcessed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Martin\Ecom\Checkout;
use Martin\Ecom\PaymentLog;
use PayPal\Api\Payment;

class ProcessPaymentStatusCommandHandler {

    protected $paymentRepo;
    /**
     * @var Checkout
     */
    private $checkout;
    private $api;

    /**
     * Create the command handler.
     *
     * @param Checkout $checkout
     * @return \App\Handlers\Commands\ProcessPaymentStatusCommandHandler
     */
	public function __construct(Checkout $checkout)
	{
        $this->checkout = $checkout;
        $this->api = $this->checkout->getApi();
        $this->paymentRepo = new \Martin\Ecom\Repositories\PaymentRepository();
    }

    /**
     * Handle the command.
     *
     * @param  ProcessPaymentStatusCommand $command
     * @throws PaymentAlreadyProcessed
     * @return void
     */
	public function handle(ProcessPaymentStatusCommand $command)
	{

        $paymentLog = new PaymentLog($this->api);

        $dbPayment = $paymentLog->fetchPaymentFromPayPal($command->paymentId);

        if ($paymentLog->isDuplicateEntry())
        {
            // TODO: Flag, send email, etc...
            // die / throw exception
            // throw new PaymentAlreadyProcessed('Duplicate Entry');

        }

        $paymentLog->logPayment();

        $paymentLog->updateState();

        $dbPayer = $paymentLog->findOrCreatePayer();

        $dbAddress = $paymentLog->findOrCreateAddress();

        $dbTransactions = $paymentLog->createTransactions();

        Log::info('Seemed to work...');



        return $dbPayment;
	}
}
