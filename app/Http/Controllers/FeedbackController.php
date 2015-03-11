<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\SendFeedbackRequest;
use Illuminate\Http\Request;
use Martin\Notifications\Flash;
use Martin\Products\Feedback;

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
     */
    public function store(SendFeedbackRequest $request)
    {
        $data = $request->all();

        $feedback = Feedback::create($data);

        $feedback->save();

        $date['id'] = $feedback->id;

        Flash::message('Your feedback has been received! We will try to contact you within 1-2 business days');

        return redirect()->back();
    }


}
