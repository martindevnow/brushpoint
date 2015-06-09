<?php namespace Martin\Quality\Repositories;

use Illuminate\Support\Facades\Mail;
use Martin\Quality\Feedback;

class EmailRepository {

    private $emailData;
    private $recipient;

    public function emailAddressRequest(Feedback $feedback, $brushType = 'battery')
    {
        if ($brushType == "battery")
            $emailTemplate = "lotCodeRequestBattery";
        else
            $emailTemplate = "lotCodeRequestRechargeable";

        Mail::send('emails.customer.'. $emailTemplate, compact('feedback'), function ($message) use ($feedback) {
            $sender = 'info@brushpoint.com';

            $message->to($feedback->email)
                ->subject('BrushPoint: Followup on Feedback ID: '. $feedback->id);
            $message->from($sender, 'BrushPoint Feedback');
        });

        // Set requested at time.
        $dt = new DateTime;
        $feedback->address_requested_at = $dt->format('y-m-d H:i:s');
        $feedback->save();
    }


    


    public function emailInternalFeedbackNotice(Feedback $feedback)
    {
        Mail::send('emails.internal.feedback', compact('feedback'), function($message) use ($feedback) {
            $recipient = 'info@brushpoint.com';

            $message->to($recipient)
                ->subject("BrushPoint: Feedback Received: ID: " . $feedback->id);
            $message->from($feedback->email, "BrushPoint: Feedback");
        });
    }



    public function emailCustomerFeedbackNotice(Feedback $feedback)
    {
        Mail::send('emails.customer.feedback', compact('feedback'), function($message) use ($feedback) {
            $sender = 'info@brushpoint.com';


            $message->to($feedback->email)
                ->subject("BrushPoint: Feedback Received: ID: " . $feedback->id);
            $message->from($sender, "BrushPoint: Feedback");
        });
    }

}