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

class AttentionModelTest extends TestCase {

    use DatabaseTransactions;


    /*public function setUp()
    {
        // $this->setBrowser('firefox');
        $this->baseUrl = 'http://bpl5.dev';
    }*/

    public function postFeedback($person)
    {
        $this->visit('feedback')
            ->type($person['name'], 'name')
            ->type($person['email'], 'email')
            ->type($person['phone'], 'phone')
            ->select('intent', $person['intent'])
            ->type($person['issue_text'], 'issue_text')
            ->press('Send Feedback');
    }

    public function getFeedbackData()
    {
        $person['name'] = 'ben';
        $person['email'] = 'ben@me.com';
        $person['phone'] = '905-934-9625';
        $person['intent'] = 'product';
        $person['issue_text'] = 'This toothbrush sucks.';

        return $person;
    }

    /** @test */
    public function it_creates_a_feedback_and_draws_attention()
    {
        $person = $this->getFeedbackData();

        $this->postFeedback($person);

        $this->seeInDatabase('feedbacks', $person);

        $feedback = Feedback::where($person)->orderBy('id', 'DESC')->first();

        $this->seeInDatabase('attentions', [
            'attentionable_type' => get_class($feedback),
            'attentionable_id' => $feedback->id,
            'action' => 'created_feedback',
        ]);
    }

    /** @test */
    public function it_checks_unsees_status()
    {
        $person = $this->getFeedbackData();

        $this->postFeedback($person);

        $feedback = Feedback::where($person)->orderBy('id', 'DESC')->first();

        $feedback->isUnseen();
    }
}
