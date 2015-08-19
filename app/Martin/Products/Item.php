<?php

namespace Martin\Products;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Martin\Core\CoreModel;
use Martin\Core\Traits\RecordsActivity;
use Martin\Ecom\SoldItem;

class Item extends CoreModel {

    use RecordsActivity;

    protected $table = 'items';


    protected $fillable = [
        'product_id',
        'name',
        'description',
        'sku',
        'price',
        'on_hand',
        'variance',
    ];



    public function addInventory(array $data)
    {
        $inventory =  new Inventory($data);

        $this->inventories()->save($inventory);

        return $inventory;
    }

    /**
     * Update the model and the row on the DB for a change int he on_hand
     *
     * @return $this
     */
    public function refreshOnHand()
    {
        $this->on_hand = $this->getActiveOnHand();
        $this->save();
        return $this;
    }


    /**
     * return the INT of the amount of units on hand (and updates the model
     *
     * @return int
     */
    public function getActiveOnHand()
    {
        $on_hand = 0;
        $invo = $this->getActiveInventory();
        foreach ($invo as $inventory)
            $on_hand += $inventory->quantity;

        return $on_hand;
    }

    public function addToOnHand($quantity)
    {
        $this->on_hand += $quantity;
        return $this->save();
    }


    public function getInventory()
    {
        $inventory = Inventory::where('item_id', '=', $this->id)
            ->active()
            ->orderBy('created_at', 'ASC')->first(); // oldest first
        return $inventory;
    }


    /**
     * @return Collection
     */
    public function getActiveInventory()
    {
        $inventory = Inventory::active()
            ->where('item_id', '=', $this->id)
            ->get();
        return $inventory;
    }


    /**
     * Returns the oldest inventory
     *
     * @return Collection
     */
    public function getOldestActiveInventories()
    {
        return Inventory::where('item_id', '=', $this->id)
            ->where('status', '!=', 'on_hold')
            ->orderBy('created_at', 'ASC')
            ->get();
    }


    /**
     * Returns an INT of the available inventory on hand
     *
     * @depreciated
     * @return int
     */
    public function getInventoryOnHand()
    {
        return $this->getActiveOnHand();
    }


    public function purchaseWasMade(SoldItem $soldItem)
    {
        $quantity = $soldItem->quantity;

        if ($quantity > $this->on_hand)
            $this->refreshOnHand();

        if ($quantity > $this->on_hand)
            throw new \Exception;

        $inventories = $this->getOldestActiveInventories();
        if ($quantity > $inventories->sum('quantity'))
            throw new \Exception;


        $remainingToDeduct = $quantity;
        Log::alert("purchase made of {$soldItem->sku} for {$remainingToDeduct} eaches.");
        foreach ($inventories as $inventory)
        {
            if ($remainingToDeduct == 0)
            {
                break;
            }



            if ($inventory->quantity >= $remainingToDeduct)
            {
                $inventory->quantity = $inventory->quantity - $remainingToDeduct;
                $inventory->save();

                $soldItem->lot_code .= $inventory->lot_code;
                Log::alert("this lot finished the order. Lot:: {$inventory->lot_code}"
                    // . print_r($inventory, true)
                );
                break;
            }

            if ($inventory->quantity < $remainingToDeduct)
            {
                $remainingToDeduct -= $inventory->quantity;

                $inventory->quantity = 0;
                $inventory->save();

                $soldItem->lot_code .= $inventory->lot_code;
                Log::alert("this sku is depleted. Lot:: {$inventory->lot_code}");

            }
        }
        $this->save();
        return $this;
    }


    public function product()
    {
        return $this->belongsTo('Martin\Products\Product');
    }

    public function purchases()
    {
        return $this->hasMany('Martin\Sales\Purchase');
    }

    public function carts()
    {
        return $this->hasMany('Martin\Products\Cart');
    }

    public function soldItems()
    {
        return $this->hasMany('Martin\Ecom\SoldItem');
    }

    public function inventories()
    {
        return $this->hasMany('Martin\Products\Inventory');
    }
} 