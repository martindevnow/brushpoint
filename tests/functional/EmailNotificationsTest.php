<?php

use App\Events\CustomerFeedbackSubmitted;
use App\Events\ProductWasPurchased;
use Laracasts\Integrated\Services\Laravel\DatabaseTransactions;
use Laracasts\TestDummy\Factory as TestDummy;
use Martin\Quality\Email;
use Martin\Quality\Feedback;
use Martin\Users\User;

class EmailNotificationsTest extends TestCase {

    use DatabaseTransactions;



    /** @test */
    public function it_creates_a_payment()
    {
        $quantity = 10;
        $item = $this->createSpecificItem();
        $inventory = $this->createInventory($item, $quantity, "10/15");


        $payment = $this->createPayment([]);
        $this->assertEquals(\Martin\Ecom\Payment::class, get_class($payment));
    }

    /** @test */
    public function it_sends_email_notifications()
    {
        $quantity = 10;
        $item = $this->createSpecificItem();
        $inventory = $this->createInventory($item, $quantity, "10/15");

        $payment = $this->createPayment([]);

        event(new ProductWasPurchased($payment));


    }

}
