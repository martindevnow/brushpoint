<?php namespace App\Handlers\Events;

use App\Events\ProductWasPurchased;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Martin\Products\Inventory;
use Martin\Products\Item;

class AdjustPurchasedInventory {

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
	 * @param  ProductWasPurchased  $event
	 * @return void
	 */
	public function handle(ProductWasPurchased $event)
	{
        $transactions = $event->payment->transactions;

        foreach($transactions as $transaction)
        {
            $soldItems = $transaction->soldItems;
            foreach($soldItems as $soldItem)
            {
                // $lotInventory = Inventory::where('item_id', '=', $soldItem->item->id);

                $item = Item::find($soldItem->item->id);
                $item->on_hand = $item->on_hand - $soldItem->quantity;
                $item->save();

                $inventory = new Inventory();
                $inventory->description = "sale";
                $inventory->item_id = $soldItem->item->id;
                $inventory->quantity = $soldItem->quantity * -1;
                $inventory->transaction_id = $transaction->id;
                $inventory->save();
            }
        }
	}
}
