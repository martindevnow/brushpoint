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

class AttentionModelTest extends TestCase {

    use DatabaseTransactions;

    /** @test */
    public function it_contacts_the_customer()
    {
        $person['name'] = 'ben';
        $person['email'] = 'ben@me.com';
        $person['phone'] = '905-934-9625';
        $person['intent'] = 'product';
        $person['issue_text'] = 'This toothbrush sucks.';

        $this->visit('feedback')
            ->type($person['name'], 'name')
            ->type($person['email'], 'email')
            ->type($person['phone'], 'phone')
            ->select('intent', $person['intent'])
            ->type($person['issue_text'], 'issue_text')
            ->press('Send Feedback');

        // $this->submitForm('Send Feedback', $person);

        $this->seeInDatabase('feedbacks', $person);




        /*$this->visit('/admins/feedback')
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
            ->press('Draft Email');*/



    }
}
