<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\GetAddressRequest;
use App\Http\Requests\SendFeedbackRequest;
use Illuminate\Http\Request;
use Martin\Notifications\Flash;
use Martin\Quality\Feedback;

class FeedbackController extends Controller {

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        // show the form for submitting a complaint
        return view('feedbacks.create');
    }

    /**
     * @param SendFeedbackRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function send(SendFeedbackRequest $request)
    {
        $data = $request->only('name', 'email', 'phone', 'retailer', 'lot_code', 'issue');

        $feedback = Feedback::create($data);

        $feedback->save();

        // store the feedback to the session
        session(['feedback' => $feedback->id]);



        Flash::message('Your feedback has been received!');

        // display the form to request their address
        return view('feedbacks.address');
    }

    /**
     * @param GetAddressRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function address(GetAddressRequest $request)
    {

        // make sure the user has already submitted their feedback
        if (! session()->has('feedback'))
            return redirect('feedback');


        $data = $request->only('street_1', 'street_2', 'city', 'province', 'postal_code', 'country');


        $feedback = Feedback::find(session('feedback'));

        $data['name'] = $feedback->name;

        $feedback->addresses()->create($data);

        session()->forget('feedback');

        Flash::message('Thank you for providing your address. We will contact you within 1-2 business days.');
        return redirect('feedback');

    }


}
