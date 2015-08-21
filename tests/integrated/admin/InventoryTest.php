<?php

use Martin\Users\User;

class InventoryTest extends TestCase {

    use \Laracasts\Integrated\Services\Laravel\DatabaseTransactions;

    /** @test */
    public function it_can_view_inventory()
    {
        $user = $this->createAdmin();
        $this->seeInDatabase('users', $user->toArray());


        $this->loginUser($user);


        $item = $this->createSpecificItem();

        $this->visit('/admins/inventory')
            ->see('TB-BEST-SOFT')
            ->onPage('/admins/inventory');

        $this->click('TB-BEST-SOFT')
            ->see('available')
            ->onPage('/admins/inventory/item/'. $item->id);
    }
}