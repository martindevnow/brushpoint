<?php

namespace Martin\Quality\Repositories;


use Illuminate\Http\Request;
use Martin\Quality\CustomerRequest;
use Martin\Quality\Feedback;

class ContactRepository {

    public $url;


    public function __constructor()
    {
    }
    // request_lot_code
    // request_address
    // request_field_sample
    // request_retailer
    // request_image
    // explain_replacement_heads_usage
    // explain_offline_sales
    /**
     * @param Request $request
     * @param Feedback $feedback
     * @param CustomerRequest $customerRequest
     * @return string
     */
    public function getBody(Request $request, Feedback $feedback, CustomerRequest $customerRequest)
    {
        $this->url = url('/');

        $body = "";
        if ($request->request_lot_code)
            $body .= $this->requestLotCode($request->brush_type);
        if ($request->request_address)
            $body.= $this->requestAddress($feedback);
        if ($request->request_field_sample)
            $body .= $this->requestFieldSample($feedback);
        if ($request->request_image)
            $body .= $this->requestImage($feedback);
        if ($request->explain_replacement_heads_usage)
            $body .= $this->explainReplacementHeadsUsage();
        if ($request->explain_offline_sales)
            $body .= $this->explainOfflineSales();
        if ($request->explain_where_to_buy)
            $body .= $this->explainWhereToBuy();
        if ($request->explain_interdental_arm)
            $body .= $this->explainInterdentalArm();
        if ($request->explain_how_to_change_batteries)
            $body .= $this->explainHowToChangeBatteries();


        if ($request->request_lot_code ||
            $request->request_address ||
            $request->request_image ||
            $request->request_field_sample
        )
            $body .= $this->requestFromCustomer($feedback, $customerRequest);


        return $body;
    }



    public function requestLotCode($brush_type = "battery")
    {
        if ($brush_type == 'battery')
        {
            $body = <<<EOT
<p>
Thank you for contacting BrushPoint Innovations and providing us with feedback.
</p>
<p>
In order for us to improve on the quality of our products; would you be able to provide us the four digit lot code at the bottom of the toothbrush.
Directly underneath where it says 'AA' battery; there is an embossed four digit lot code that is very faint that looks something like 14/15.
It may be a bit difficult to read but if you shine a light or use a magnifying glass on it; this may make it easier.
</p>


EOT;
        }
        else // ($brush_type == 'rechargeable')
        {
            $body = <<<EOT
<p>
Thank you for contacting BrushPoint Innovations and providing us with feedback.
</p>
<p>
In order for us to improve on the quality of our products would you be able to locate the 4 digit lot code at the bottom of the charger.
The code may be a bit difficult to read but if you shine it against the light or use a magnifying glass, it may be easier.
The format of the code should look something like 14/14A.
</p>

EOT;
        }
        return $body;
    }


    public function requestAddress($feedback)
    {
        $body = <<<EOT
<p>
We would be happy to send you a replacement unit if you can provide us with a full mailing address.
</p>
<p>
Please click the following link and fill in your address and we will have the replacement sent to you.
</p>

EOT;
        return $body;
    }



    public function requestFieldSample($feedback)
    {
        $body = <<<EOT
<p>
In addition, we would like to request for the defective unit to be returned to our facility for further investigation.
We will send you a prepaid envelope, along with your replacement unit.
Please put the defective unit into the prepaid envelope and return it at a local post office destination (Canada - Canada Post; United States - Fedex).
</p>

EOT;
        return $body;
    }


    public function requestImage($feedback)
    {
        $body = <<<EOT
<p>
In order for us to understand the issue better, would you be able to send us a photo for evaluation please.
</p>

EOT;
        return $body;
    }


    public function explainReplacementHeadsUsage()
    {
        $body = <<<EOT
<p>
To replace the replacement heads, simply hold the neck of the toothbrush in one hand, and the handle of the toothbrush in the other, and pull really hard in the two opposite directions.
You will not break the toothbrush.
Please let us know if these instructions helped.
</p>

EOT;
        return $body;
    }


    public function explainOfflineSales()
    {
        return "EXPLAIN OFFLINE_SALES
        ";
        $body = <<<EOT


EOT;
        return $body;
    }

    private function explainWhereToBuy()
    {

        $body = <<<EOT
<p>
Replacement heads can only be purchased online at the moment through our website www.brushpoint.com.
We are working hard to get these replacement heads available in store.
</p>

EOT;
        return $body;
    }

    private function explainInterdentalArm()
    {
        $body = <<<EOT
<p>
To change interdental accessories, take the interdental arm off of the toothbrush.
At the bottom of the interdental arm, there is a collar piece, pull this piece down (this is figure 6 on the back of the package).
Change the accessories, and push the collar piece back up to lock it in place.
Please let us know if these instructions were helpful.
</p>

EOT;
        return $body;
    }


    private function explainHowToChangeBatteries()
    {
        $body = <<<EOT
<p>
The battery compartment is located at the bottom of the toothbrush.
Simply pull this battery cap off to replace the batteries.
If this doesn't work, hold the toothbrush handle in one hand, and the battery compartment in the other, and bend the two pieces at a 45 degree angle downwards.
The batteries should pop out. Please let us know if these instructions helped.
</p>

EOT;
        return $body;
    }




    public function getSubject($feedback)
    {
        return 'BrushPoint Feedback: ' .$feedback->id;
    }


    public function getTitle()
    {
        return 'Thank you for your feedback!';
    }


    public function getToEmail($feedback)
    {
        return $feedback->email;
    }


    public function getFromEmail()
    {
        return "noreply@brushpoint.com";
    }





    public function requestFromCustomer(Feedback $feedback, CustomerRequest $customerRequest)
    {
        $body = <<<EOT
<p>
<a href="$this->url/feedback/edit/$feedback->id/$customerRequest->id/$customerRequest->hash">
        [Click Here to Provide the Requested Information]
</a>
</p>

EOT;
        return $body;
    }



}
