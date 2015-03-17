<?php namespace App\Handlers\Commands;

use App\Commands\ProcessPaymentStatusCommand;

use Illuminate\Queue\InteractsWithQueue;

class ProcessPaymentStatusCommandHandler {

	/**
	 * Create the command handler.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}

	/**
	 * Handle the command.
	 *
	 * @param  ProcessPaymentStatusCommand  $command
	 * @return void
	 */
	public function handle(ProcessPaymentStatusCommand $command)
	{
		dd($command);
	}

}
