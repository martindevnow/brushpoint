<?php namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider {

	/**
	 * The event handler mappings for the application.
	 *
	 * @var array
	 */
	protected $listen = [
		'App\Events\ProductWasPurchased' => [
			'App\Handlers\Events\EmailPurchaseConfirmation',
            'App\Handlers\Events\GenerateInvoicePdf',
            'App\Handlers\Events\ClearCurrentCart',
            'App\Handlers\Events\AdjustPurchasedInventory',
		],

        'App\Events\PackageWasShipped' => [
            'App\Handlers\Events\EmailShippingConfirmation',
        ],

        'App\Events\CustomerContactedUs' => [
            'App\Handlers\Events\EmailInternalContactNotice',
            'App\Handlers\Events\EmailCustomerContactNotice',
        ],

        'App\Events\CustomerFeedbackSubmitted' => [
            'App\Handlers\Events\EmailInternalFeedbackNotice',
            'App\Handlers\Events\EmailCustomerFeedbackNotice',
        ],

	];

	/**
	 * Register any other events for your application.
	 *
	 * @param  \Illuminate\Contracts\Events\Dispatcher  $events
	 * @return void
	 */
	public function boot(DispatcherContract $events)
	{
		parent::boot($events);
	}

}
