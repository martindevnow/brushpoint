<?php namespace App\Commands;

use App\Commands\Command;

class ProcessPaymentStatusCommand extends Command {

    /**
     * @var
     */
    public $paymentId;

    /**
     * Create a new command instance.
     *
     * @param $paymentId
     * @return \App\Commands\ProcessPaymentStatusCommand
     */
	public function __construct($paymentId)
	{

        $this->paymentId = $paymentId;
    }

}
