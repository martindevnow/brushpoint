<?php namespace App\Handlers\Events;

use App\Events\InventoryPlacedOnHold;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class RemoveInventoryFromOnHandOfItem {

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
	 * @param  InventoryPlacedOnHold  $event
	 * @return void
	 */
	public function handle(InventoryPlacedOnHold $event)
	{
        $inventory = $event->inventory;

        $item = $inventory->item;
        $item->on_hand = $item->on_hand - $inventory->quantity;

        $item->save();
	}

}
