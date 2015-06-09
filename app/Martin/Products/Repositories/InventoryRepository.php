<?php

namespace Martin\Products\Repositories;

use Martin\Products\Inventory;
use Martin\Products\Item;

class InventoryRepository {


    public function getSellableInventoryBySKU($sku)
    {
        $item = Item::where('sku', '=', $sku);

        return $this->getSellableInventoryById($item->id);
    }


    public function getSellableInventoryById($id)
    {
        $dt = new \DateTime();
        return Inventory::where('item_id', '=', $id)
            ->where('quantity', '>', 0)
            ->where('expiry_date', '>', $dt->format('y-m-d'))
            ->orderBy('expiry_date', 'ASC')
            ->first();
    }
}