<?php

namespace Martin\Quality\Repositories;


use Illuminate\Http\Request;
use Martin\Quality\Feedback;

class ContactRepository {

    public $url;


    public function __constructor()
    {
        $this->url = url('/');
    }
    // request_lot_code
    // request_address
    // request_product_return
    // explain_replacement_heads_usage
    // explain_offline_sales
    /**
     * @param Request $request
     * @param Feedback $feedback
     * @return string
     */
    public function getBody(Request $request, Feedback $feedback)
    {
        $body = "";
        if ($request->request_lot_code)
            $body .= $this->requestLotCodeBody($request->brush_type);
        if ($request->request_address)
            $body.= $this->requestAddressBody($feedback);
        if ($request->request_product_return)
            $body .= $this->requestProductReturn($feedback);
        if ($request->explain_replacement_heads_usage)
            $body .= $this->explainReplacementHeadsUsage();
        if ($request->explain_offline_sales)
            $body .= $this->explainOfflineSales();



        return $body;
    }



    public function requestLotCodeBody($brush_type = "battery")
    {
        if ($brush_type == 'battery')
        {
            $body = <<<EOT
<p>
Thank you for contacting BrushPoint Innovations and providing us with feedback.
</p>
<p>
In order for us to improve on the quality of our products; would you be able to provide us the four digit lot code at the bottom of the toothbrush. Directly underneath where it says 'AA' battery; there is an embossed four digit lot code that is very faint that looks something like 14/15. It may be a bit difficult to read but if you shine a light or use a magnifying glass on it; this may make it easier.
</p>


EOT;
        } else // ($brush_type == 'rechargeable')
        {
            $body = <<<EOT
<p>
Thank you for contacting BrushPoint Innovations and providing us with feedback.
</p>
<p>
In order for us to improve on the quality of our products would you be able to locate the 4 digit lot code at the bottom of the charger. The code may be a bit difficult to read but if you shine it against the light or use a magnifying glass, it may be easier. The format of the code should look something like 14/14A.
</p>

EOT;
        }
        return $body;
    }


    public function requestAddressBody($feedback)
    {
        $body = <<<EOT
<p>
We would be happy to send you a replacement unit if you can provide us with a full mailing address.
</p>
<p>
Please click the following link and fill in your address and we will have the replacement sent to you.
</p>
<p>
<a href="$this->url/feedback/edit/$feedback->id/$feedback->hash">
        [Click Here]
</a>
</p>

EOT;
        return $body;
    }



    public function requestProductReturn($feedback)
    {
        $body = <<<EOT


EOT;
        return $body;
    }


    public function explainReplacementHeadsUsage()
    {
        $body = <<<EOT


EOT;
        return $body;
    }


    public function explainOfflineSales()
    {
        $body = <<<EOT


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
        return "info@brushpoint.com";
    }








} 