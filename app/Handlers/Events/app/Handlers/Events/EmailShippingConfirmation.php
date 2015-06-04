<?php namespace App\Handlers\Events\app\Handlers\Events;

use App\Events\PackageWasShipped;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class EmailShippingConfirmation {

	/**
	 * Create the event handler.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}

	/**
	 * Handle the event.
	 *
	 * @param  PackageWasShipped  $event
	 * @return void
	 */
	public function handle(PackageWasShipped $event)
	{
		//
	}

}
