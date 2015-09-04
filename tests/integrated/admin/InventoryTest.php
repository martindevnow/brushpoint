<?php

use Martin\Products\Inventory;
use Martin\Users\User;

class InventoryTest extends TestCase {


    /** @test */
    public function it_can_view_inventory()
    {
        $user = $this->createAdmin();
        $this->seeInDatabase('users', $user->toArray());

        $this->loginUser($user);

        $result = $this->createProductItemInventory();

        $product = $result['product'];
        $item = $result['item'];
        $invo = $result['inventory'];

        $this->visit('/admins/inventory')
            ->see($item->sku)
            ->onPage('/admins/inventory');

        $this->click($item->sku)
            ->see($item->status)
            ->onPage('/admins/inventory/item/'. $item->id);
    }


    /** @test */
    public function it_can_create_new_inventory_for_items()
    {
        $user = $this->createAdmin();
        $this->seeInDatabase('users', $user->toArray());

        $this->loginUser($user);

        $result = $this->createProductItemInventory();

        $product = $result['product'];
        $item = $result['item'];
        $invo = $result['inventory'];


        $this->visit('/admins/inventory')
            ->see($item->sku)
            ->onPage('/admins/inventory');


        $newInvoData = [
            'item_id' => $item->id,
            'lot_code'
        ];

        $this->click('New Inventory')
            ->see('Item / SKU:')
            ->type('15/15', 'lot_code')
            ->select('item_id', $item->id)
            ->type('09/28/2017', 'expiry_date')
            ->type('100', 'quantity')
            ->type('available', 'status')
            ->press('Save');

        $inventory = Inventory::all();
        $this->assertCount(2, $inventory);



    }


}