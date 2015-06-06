<?php namespace App\Http\Controllers;

use App\Events\CustomerFeedbackSubmitted;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\GetAddressRequest;
use App\Http\Requests\SendFeedbackRequest;
use Illuminate\Http\Request;
use Martin\Notifications\Flash;
use Martin\Quality\Feedback;

class FeedbackController extends Controller {

    /**
     * Show the form for creating a new feedback submission.
     *
     * @return Response
     */
    public function create()
    {
        // show the form for submitting a complaint
        return view('feedback.create');
    }

    /**
     * Submit the feedback to the server and save it
     *
     * @param SendFeedbackRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function send(SendFeedbackRequest $request)
    {
        $data = $request->only('name', 'email', 'phone', 'retailer_text', 'lot_code', 'issue_text');
        $data['hash'] = bcrypt(time());

        $feedback = Feedback::create($data);
        // $feedback->save();

        event(new CustomerFeedbackSubmitted($feedback));

        Flash::message('Your feedback has been received!');

        return redirect('feedback/thankyou');

    }


    /**
     * Display the form to enter the address to send a replacement toothbrush
     *
     * @param $id
     * @param $hash
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function createAddress($id, $hash)
    {
        $feedback = Feedback::find($id);

        if ($hash == $feedback->hash)
            return view('feedback.address')->with(compact('feedback'));
        else
            return redirect('/');

    }

    /**
     * Save the address entered to the feedback it is related to
     *
     * @param GetAddressRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function storeAddress($id, $hash, GetAddressRequest $request)
    {
        $feedback = Feedback::find($id);

        if ($feedback->hash != $hash)
            return redirect('/');

        $data = $request->only('street_1', 'street_2', 'city', 'province', 'postal_code', 'country');

        $data['name'] = $feedback->name;

        $feedback->addresses()->create($data);

        Flash::message('Your message has been sent!');

        // create event?
        // send email to the user?
        return redirect('feedback/thankyou');

    }

    /**
     * Display a simple thank you page
     *
     * @return \Illuminate\View\View
     */
    public function thankyou()
    {
        return view('feedback.thankyou');
    }



    public function editLotCodeAndAddress($id, $hash)
    {
        $feedback = Feedback::find($id);
        if ($feedback->hash != $hash)
            return redirect('/');

        return view('feedback.editLotCodeAndAddress')
            ->with(compact('feedback'));
    }

    public function storeLotCodeAndAddress($id, $hash, GetAddressRequest $request)
    {
        $feedback = Feedback::find($id);

        if ($feedback->hash != $hash)
            return redirect('/');

        $data = $request->only('street_1', 'street_2', 'city', 'province', 'postal_code', 'country');

        $data['name'] = $feedback->name;

        $feedback->addresses()->create($data);
        $feedback->lot_code = $request->lot_code;

        $feedback->save();

        Flash::message('Your message has been sent!');

        // create event?
        // send email to the user?
        return redirect('feedback/thankyou');

    }
}
