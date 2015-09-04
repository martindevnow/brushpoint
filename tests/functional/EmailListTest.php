<?php

use App\Events\CustomerFeedbackSubmitted;
use App\Events\ProductWasPurchased;
use Laracasts\Integrated\Services\Laravel\DatabaseTransactions;
use Laracasts\TestDummy\Factory as TestDummy;
use Martin\Quality\Email;
use Martin\Quality\Feedback;
use Martin\Users\User;

class EmailListTest extends TestCase {

    use DatabaseTransactions;

//    /** @test */
//    public function it_creates_an_email_list()
//    {
//        $type = CustomerFeedbackSubmitted::class;
//        $emailList = $this->createAnEmailList($type);
//
//        $this->assertEquals(Email::class, get_class($emailList));
//    }
//
//
//    /** @test */
//    public function email_list_supports_string_and_array_lists()
//    {
//        $type = CustomerFeedbackSubmitted::class;
//        $email = 'the.one.martin+staff@gmail.com';
//        $emailList = $this->createAnEmailList($type, $email);
//
//        $this->assertEquals($email, $emailList->recipient_list);
//
//        $emails = [$email, 'the.one.spam+staff@gmail.com'];
//        $emailList2 = $this->createAnEmailList($type, $emails);
//
//        $this->assertEquals($emails, $emailList2->recipient_list);
//    }
//
//
//    /** @test */
//    public function it_retrieves_email_list_by_type()
//    {
//        $type = CustomerFeedbackSubmitted::class;
//        $emailList = $this->createAnEmailList($type);
//        $emails = Email::where('email_type', '=', $type)->first();
//
//    }
//
//    /** @test */
//    public function it_sends_an_email_when_the_event_is_fired()
//    {
//        $type = CustomerFeedbackSubmitted::class;
//        $emailList = $this->createAnEmailList($type);
//
//        $feedback = $this->createFeedback();
//        Event::fire(new CustomerFeedbackSubmitted($feedback));
//
//        // 2015-08-20 @ 23:52 -- this test sent an email to the feedback maker, not internal though
//        //         21 @ 00:09 -- this test sent to one staff and one customer
//    }
//
//    /** @test */
//    public function it_sends_email_to_multiple_staff_members()
//    {
//        $type = CustomerFeedbackSubmitted::class;
//        $emailList = $this->createAnEmailList($type, [
//            'the.one.martin+staff1@gmail.com',
//            'the.one.martin+staff2@gmail.com',
//            'the.one.martin+staff3@gmail.com',
//        ]);
//
//        $feedback = $this->createFeedback();
//        Event::fire(new CustomerFeedbackSubmitted($feedback));
//        // 2015-08-21 @ 00:10 -- sent to all 3 users.
//    }



    /** @test */
    public function it_supports_product_was_purchased_events()
    {
        $type = ProductWasPurchased::class;
        $emailList = $this->createAnEmailList($type, [
            'the.one.martin+staff3@gmail.com',
        ]);

        $quantity = 10;
        $item = $this->createSpecificItem();
        $inventory = $this->createInventory($item, $quantity, "10/15");


        $payment = $this->createPayment([]);
        $this->assertEquals(\Martin\Ecom\Payment::class, get_class($payment));

        $amountToBuy = 2;
        $payment = $this->purchaseItem($payment, $item, $amountToBuy);

        event(new ProductWasPurchased($payment));
    }





    public function createFeedback($name = 'Ben', $email = 'the.one.martin+customer@gmail.com', $intent = 'product')
    {
        $data = [
            'name' => $name,
            'email' => $email,
            'phone' => '905-934-9625',
            'issue_text' => 'this toothbrush is bad',
            'intent' => $intent,
        ];
        $feedback = Feedback::create($data);
        $feedback->save();
        return $feedback;
    }



    public function createAnEmailList($type, $list = ['the.one.martin+staff@gmail.com'])
    {
        $emailList = new Email([
            'email_type' => $type,
            'recipient_list' => $list
        ]);
        $emailList->save();
        return $emailList;
    }
}
