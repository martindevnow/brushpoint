<?php namespace App\Events;

use App\Events\Event;

use Illuminate\Queue\SerializesModels;
use Martin\Products\Inventory;

class InventoryIncreased extends Event {

	use SerializesModels;
    /**
     * @var Inventory
     */
    public $inventory;

    /**
     * Create a new event instance.
     *
     * @param Inventory $inventory
     * @return \App\Events\InventoryIncreased
     */
	public function __construct(Inventory $inventory)
	{
		//
        $this->inventory = $inventory;
    }

}
