<?php

use Martin\Core\Attention;
use Illuminate\Support\Facades\Log;
use Laracasts\Integrated\Services\Laravel\DatabaseTransactions;
use Laracasts\TestDummy\Factory as TestDummy;
use Martin\Core\Address;
use Martin\Ecom\Payer;
use Martin\Ecom\Payment;
use Martin\Ecom\SoldItem;
use Martin\Ecom\Transaction;
use Martin\Products\Inventory;
use Martin\Products\Item;
use Martin\Quality\Feedback;
use Martin\Users\User;

class TrashModelTest extends TestCase {

    use DatabaseTransactions;


    /** @test */
    public function it_creates_an_item_and_requests_delete()
    {
        $user = $this->createAdmin();
        $this->loginUser($user);

        $item = $this->createSpecificItem();
        $item->requestDelete();

        $this->assertCount(1, $item->trash);
    }


    /** @test */
    public function it_authorizes_a_delete_request()
    {
        $user = $this->createAdmin();
        $this->loginUser($user);

        $item = $this->createSpecificItem();
        $item->requestDelete();

        // Get the item from the DB (fresh)
        $item = Item::with('trash')->find($item->id);
        $this->assertCount(1, $item->trash);

        // get the delete request
        $drs = $item->trash->first();
        $del_req = \Martin\Core\Trash::find($drs->id);
        $del_req->authorize();

        // Item no longer exists
        $this->assertNull(Item::find($item->id));

        // Item CAN be fetched explicitly
        $item = Item::withTrashed()->find($item->id);
        $this->assertEquals(Martin\Products\Item::class, get_class($item));
        $this->assertNotEquals(0, $item->deleted_at);

        // item still exists in the database
        $this->seeInDatabase('trash', [
            'user_id' => $user->id,
            'trashable_id' => $item->id,
            'trashable_type' => get_class($item)
        ]);
    }

    /**
     * @test
     * @expectedException App\Exceptions\UserNotLoggedIn
     */
    public function it_cannot_make_trash_without_account ()
    {
        $user = $this->createAdmin();

        // DO NOT LOGIN
        // $this->loginUser($user);

        $item = $this->createSpecificItem();

        $item->requestDelete();

        $this->assertCount(0, $item->trash);
    }
}
