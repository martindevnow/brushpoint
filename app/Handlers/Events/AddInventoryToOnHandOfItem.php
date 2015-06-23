<?php namespace App\Handlers\Events;

use App\Events\InventoryIncreased;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class AddInventoryToOnHandOfItem {

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
     * @param InventoryIncreased $event
     * @return void
     */
    public function handle(InventoryIncreased $event)
    {
        $inventory = $event->inventory;

        $item = $inventory->item;
        $item->on_hand = $item->on_hand + $inventory->quantity;

        $item->save();
    }

}
