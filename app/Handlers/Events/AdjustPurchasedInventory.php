<?php namespace App\Handlers\Events;

use App\Events\ProductWasPurchased;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Martin\Products\Inventory;
use Martin\Products\Item;
use Martin\Products\Repositories\InventoryRepository;

class AdjustPurchasedInventory {
    /**
     * @var InventoryRepository
     */
    public $inventoryRepository;

    /**
     * Create the event handler.
     *
     * @param InventoryRepository $inventoryRepository
     * @return \App\Handlers\Events\AdjustPurchasedInventory
     */
	public function __construct(InventoryRepository $inventoryRepository)
	{
		//
        $this->inventoryRepository = $inventoryRepository;
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

                $item = Item::find($soldItem->item->id);
                $item->on_hand = $item->on_hand - $soldItem->quantity;
                $item->save();


                $activeInventory = $this->inventoryRepository->getSellableInventoryById($soldItem->item->id);
                $activeInventory->quantity = $activeInventory->quantity - $soldItem->quantity;
                $activeInventory->save();


                $soldItem->lot_code = $activeInventory->lot_code;
                $soldItem->save();
            }
        }
	}
}
