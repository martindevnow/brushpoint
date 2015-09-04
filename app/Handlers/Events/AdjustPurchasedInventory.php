<?php namespace App\Handlers\Events;

use App\Events\ProductWasPurchased;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Martin\Products\Item;

class AdjustPurchasedInventory {

    /**
     * Create the event handler.
     *
     * @return \App\Handlers\Events\AdjustPurchasedInventory
     */
	public function __construct()
	{
		//
    }

    /**
     * Handle the event.
     *
     * @param  ProductWasPurchased  $event
     *
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
                $item = Item::findOrFail($soldItem->item->id);
                $item->purchaseWasMade($soldItem);
                $item->save();
            }
        }
    }
}
