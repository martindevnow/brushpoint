<?php
/**
 * User: benjaminm
 * Date: 19/08/2015
 * Time: 5:20 PM
 */

class InventoryModelTest extends TestCase {

    /** @test */
    public function it_creates_an_item()
    {
        $item = $this->createSpecificItem();
        $this->assertEquals(Martin\Products\Item::class, get_class($item));

        $inventory = $this->createInventory($item);
        $this->assertEquals(Martin\Products\Inventory::class, get_class($inventory));

    }
}