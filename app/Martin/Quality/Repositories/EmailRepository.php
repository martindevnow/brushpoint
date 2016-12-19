<?php namespace Martin\Quality\Repositories;

use DateTime;
use Illuminate\Support\Facades\Mail;
use Martin\Ecom\Payment;
use Martin\Quality\Contact;
use Martin\Quality\Email;
use Martin\Quality\Feedback;

class EmailRepository {

    private $emailData;
    private $recipient;



    public function getRecipientsByType($type)
    {
        $emails = Email::where('email_type', '=', $type)->first();
        return $emails->recipient_list;
    }

    public function emailCustomer(Feedback $feedback, Contact $contact)
    {

        Mail::send($contact->email_template, compact('feedback', 'contact'), function($message) use ($feedback, $contact) {

//            $from_email = $contact->from_email;
	    $from_email = "noreply@brushpoint.com";
            $to_email = $contact->to_email;

            $message->to($to_email)
                ->subject($contact->subject);
            $message->from($from_email, "BrushPoint: Feedback");
        });
    }



    public function emailAddressRequest(Feedback $feedback, $brushType = 'battery')
    {
        if ($brushType == "battery")
            $emailTemplate = "lotCodeRequestBattery";
        else
            $emailTemplate = "lotCodeRequestRechargeable";

        Mail::send('emails.customer.'. $emailTemplate, compact('feedback'), function ($message) use ($feedback) {
            $sender = 'noreply@brushpoint.com';

            $message->to($feedback->email)
                ->subject('BrushPoint: Followup on Feedback ID: '. $feedback->id);
            $message->from($sender, 'BrushPoint Feedback');
        });

        // Set requested at time.
        $dt = new DateTime;
        $feedback->address_requested_at = $dt->format('y-m-d H:i:s');
        $feedback->save();
    }


    


    public function emailInternalFeedbackNotice(Feedback $feedback, $type)
    {
        $emails = Email::where('email_type', '=', $type)->first();

        Mail::send('emails.internal.feedback', compact('feedback'), function($message) use ($feedback, $emails) {
            //$recipient = ($emails ? $emails->recipient_list : "info@brushpoint.com");
	    $recipient = "info@brushpoint.com";

            $message->to($recipient)
                ->subject("Feedback Received: ID: " . $feedback->id);
            $message->from('noreply@brushpoint.com',
			//$feedback->email, 
			"BrushPoint: Feedback");
        });
    }



    public function emailCustomerFeedbackNotice(Feedback $feedback)
    {
        Mail::send('emails.customer.feedback', compact('feedback'), function($message) use ($feedback) {
            $sender = 'noreply@brushpoint.com';


            $message->to($feedback->email)
                ->subject("BrushPoint: Thank you for your feedback (ID-" . $feedback->id .')');
            $message->from($sender, "BrushPoint: Feedback");
        });
    }



    public function emailInternalPurchaseNotice(Payment $payment, $type)
    {
        // $emails = $this->getRecipientsByType($type);
        $emails = "noreply@brushpoint.com";

        $payer = $payment->payer;
        $address = $payment->address; // can have different recipient
        $transactions = $payment->transactions->all(); // array of transactions

        $data = compact('payment', 'payer', 'address', 'transactions');

        Mail::send('emails.internal.purchased', $data, function($message) use ($payment, $emails) {
            $message->to($emails)
                ->subject("BrushPoint: Order Received" . $payment->id);
            $message->from('orders@brushpoint.com', 'BrushPoint Orders');
        });
    }



    public function emailCustomerPurchaseNotice(Payment $payment)
    {
        $payer = $payment->payer;
        $address = $payment->address; // can have different recipient
        $transactions = $payment->transactions->all(); // array of transactions

        $data = compact('payment', 'payer', 'address', 'transactions');

        Mail::send('emails.customer.invoice', $data, function($message) use ($payment) {
            $message->to($payment->payer->email)
                ->subject("BrushPoint: Purchase Receipt");
            $message->from('noreply@brushpoint.com', 'BrushPoint Orders');
        });
    }


    public function emailCustomerReplacementShipped(Feedback $feedback)
    {
        $recipient = $feedback->email;

        Mail::send('emails.customer.replacementShipped', $feedback, function($message) use ($recipient) {
            $message->to($recipient)
                ->subject('BrushPoint: Your replacement has been shipped');
            $message->from('noreply@brushpoint.com', 'BrushPoint Information');
        });
    }
}
