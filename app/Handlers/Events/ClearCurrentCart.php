<?php namespace App\Handlers\Events;

use App\Events\ProductWasPurchased;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Martin\Products\CartRepository;

class ClearCurrentCart {

    /**
     * @var CartRepository
     */
    private $cartRepository;

    /**
	 * Create the event handler.
	 *
	 * @return void
	 */
	public function __construct(CartRepository $cartRepository)
	{
		//
        $this->cartRepository = $cartRepository;
    }

	/**
	 * Handle the event.
	 *
	 * @param  ProductWasPurchased  $event
	 * @return void
	 */
	public function handle(ProductWasPurchased $event)
	{
		$this->cartRepository->clearCart();
	}

}
