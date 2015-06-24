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
        /**
         * Payment and PayPal related
         */
		'App\Events\ProductWasPurchased' => [
			'App\Handlers\Events\EmailPurchaseConfirmation',
            'App\Handlers\Events\GenerateInvoicePdf',
            'App\Handlers\Events\ClearCurrentCart',
            'App\Handlers\Events\AdjustPurchasedInventory',
		],


        'App\Events\PackageWasShipped' => [
            'App\Handlers\Events\EmailShippingConfirmation',
        ],

        /**
         * Customer Feedback and Contacting Customers
         */

        'App\Events\CustomerFeedbackSubmitted' => [
            'App\Handlers\Events\EmailInternalFeedbackNotice',
            'App\Handlers\Events\EmailCustomerFeedbackNotice',
        ],

        'App\Events\ContactCustomerIssued' => [
            'App\Handlers\Events\SendContactToCustomer',
            'App\Handlers\Events\OpenComplaintInvestigation',
        ],

        'App\Events\RequestForRetailerInfoIssued' => [
            'App\Handlers\Events\EmailRequestForLotCodeAndAddress',
        ],


        /**
         * Inventory Stuff
         */
        'App\Events\InventoryPlacedOnHold' => [
            'App\Handlers\Events\RemoveInventoryFromOnHandOfItem',
        ],

        'App\Events\InventoryIncreased' => [
            'App\Handlers\Events\AddInventoryToOnHandOfItem',
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
