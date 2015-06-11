<?php

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
use Martin\Users\User;

class ContactCustomerTest extends TestCase {

    use DatabaseTransactions;

    /** @test */
    public function it_contacts_the_customer()
    {
        $this->visit('/admins/feedback')
            ->type('ben@me.com', 'email')
            ->type('123456', 'password')
            ->press('Login')
            ->see('New Feedback')
            ->onPage('/admins/feedback');


        $this->visit('/admins/feedback/1')
            ->see('Contact the Customer')
            ->onPage('/admins/feedback/1')
            // ->press('Contact the Customer');
            ->see('Request Lot Code:')
            ->tick('request_lot_code')
            ->tick('request_address')
            ->press('Draft Email');

    }
}
