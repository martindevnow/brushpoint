<?php

use App\Events\ProductWasPurchased;
use Laracasts\Integrated\Services\Laravel\DatabaseTransactions;
use Laracasts\TestDummy\Factory as TestDummy;
use Martin\Core\Address;
use Martin\Ecom\Payer;
use Martin\Ecom\Payment;
use Martin\Ecom\SoldItem;
use Martin\Ecom\Transaction;
use Martin\Products\Inventory;
use Martin\Products\Item;

class InventoriesTest extends TestCase {

    use DatabaseTransactions;


    /*
     * TESTS
     */


    /** @test */
    public function it_creates_an_item()
    {
        $item = $this->createSpecificItem();
        $this->assertEquals(get_class($item), "Martin\\Products\\Item");
    }

    /** @test */
    public function it_creates_inventory()
    {
        $item = $this->createSpecificItem();

        $quantity = 1;
        $inventory = $this->createInventory($item, $quantity, '30/15', 'available');

        $this->assertEquals(get_class($inventory), "Martin\\Products\\Inventory");
        $this->assertEquals($item->name, $inventory->item->name);
        $this->assertEquals($inventory->sku, $item->inventories->first()->sku);

        $item = $this->refreshItem($item);
        $this->assertEquals($quantity, $inventory->item->on_hand);
    }

    /** @test */
    public function it_updates_on_hand_properly()
    {
        $item = $this->createSpecificItem();

        $quantity = 10;
        $inventory = $this->createInventory($item, $quantity, '30/15', 'on_hold');
        $inventory2 = $this->createInventory($item, $quantity, '30/15');

        $item = $this->refreshItem($item);
        $this->assertEquals($quantity, $item->on_hand);
    }

    /** @test */
    public function it_gets_active_inventory()
    {
        $item = $this->createSpecificItem();
        $quantity = 100;
        $inventory = $this->createInventory($item, $quantity, '30/15', 'on_hold');
        $inventory2 = $this->createInventory($item, $quantity, '30/15');

        $result = $item->getActiveInventory();

        $this->assertEquals(get_class($result), \Illuminate\Database\Eloquent\Collection::class);
        $this->assertEquals($result->count(), 1);
        $this->assertEquals($result->first()->quantity, $quantity);
    }

    /** @test */
    public function it_gets_active_on_hand(){
        $item = $this->createSpecificItem();
        $quantity = 500;
        $inventory = $this->createInventory($item, $quantity, '30/15', 'on_hold');
        $inventory2 = $this->createInventory($item, $quantity, '30/15');

        $this->assertEquals($quantity, $item->getActiveOnHand());
    }


    /** @test */
    public function it_gets_on_hand()
    {
        $quantity = 1000;
        $item = $this->createSpecificItem();
        $inventory = $this->createInventory($item, $quantity, "10/15");
        $inventory2 = $this->createInventory($item, $quantity, "10/15", 'on_hold');

        $item = $this->refreshItem($item);
        $this->assertEquals($inventory->quantity, $item->on_hand);
    }

    /** @test */
    public function it_gets_the_oldest_inventory()
    {
        $quantity = 5000;
        $item = $this->createSpecificItem();
        $inventory = $this->createInventory($item, $quantity, "10/15");
        $inventory2 = $this->createInventory($item, $quantity, "10/14");

        $oldInventory = $item->getOldestActiveInventories()->first();

        $this->assertEquals($oldInventory->lot_code, $inventory->lot_code);
    }


    /** @test  */
    public function it_modifies_active_inventory()
    {
        $quantity = 5;

        $item = $this->createSpecificItem();
        $inventory = $this->createInventory($item, $quantity, "10/15");

        $item = $this->refreshItem($item);
        $this->assertEquals($quantity, $item->on_hand);


        $inventory2 = $this->createInventory($item, $quantity, '30/15');
        $item = $this->refreshItem($item);
        $this->assertEquals($quantity * 2, $item->on_hand);


        $activeOnHand = $item->getActiveOnHand();
        $this->assertEquals($quantity * 2, $activeOnHand);


        $newQuantity = 100;
        $inventory->quantity = $newQuantity;
        $inventory->save();

        $item = $this->refreshItem($item);
        $this->assertEquals($newQuantity + $quantity, $item->on_hand);

    }







    /*
     * TESTS
     * -- INVENTORY TESTS INTEGRATED WITH PURCHASING
     */





    /** @test */
    public function it_purchases_a_product()
    {
        $quantity = 10;
        $item = $this->createSpecificItem();
        $inventory = $this->createInventory($item, $quantity, "10/15");


        $payment = $this->createPayment([
            $item, 2
        ]);
        event(new ProductWasPurchased($payment));
    }




}
