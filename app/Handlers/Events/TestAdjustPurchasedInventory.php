<?php namespace App\Handlers\Events;

use App\Events\TestProductWasPurchased;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Martin\Products\Item;

class TestAdjustPurchasedInventory {


    /**
     * Create the event handler.
     *
     * @return \App\Handlers\Events\TestAdjustPurchasedInventory
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  TestProductWasPurchased  $event
     *
     * @return void
     */
    public function handle(TestProductWasPurchased $event)
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
