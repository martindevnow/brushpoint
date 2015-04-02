<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Martin\Notifications\Flash;
use Martin\Quality\Feedback;

class FeedbackController extends Controller {


    /**
     * Display all feedback (paginated)
     *
     * @return $this
     */
    public function index()
    {
        $feedbacks = Feedback::orderBy('created_at', 'desc')->paginate(25);
        return $this->layout->content = view('admin.feedback.index')->with(compact('feedbacks'));
    }


    /**
     * Show the form for creating a new Feedback entry.
     *
     * @return Response
     */
    public function create()
    {
        $this->layout->content = view('admin.feedback.create');
    }


    /**
     * Store a new Feedback submitted by QA department
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');
        $feedback = Feedback::create($data);
        $feedback->save();

        // store the feedback to the session
        session(['feedback' => $feedback->id]);

        Flash::message('The customer Complaint has been Stored');

        // display the form to request their address
        return redirect()->to('admins/feedback');
        // $this->layout->content = view('admin.feedback.index');
    }


    /**
     * Display one individual Feedback entry
     *
     * @param $feedbackId
     * @return $this
     */
    public function show($feedbackId)
    {
        $feedback = Feedback::find($feedbackId);
        return $this->layout->content = view('admin.feedback.show')->with(compact('feedback'));
    }


    /**
     * Show the form to edit the details of a Feedback entry
     *
     * @param $feedbackId
     * @return $this
     */
    public function edit($feedbackId)
    {
        $feedback = Feedback::find($feedbackId);
        return $this->layout->content = view('admin.feedback.edit')->with(compact('feedback'));
    }


    /**
     * Save the changes to the feedback and redirect back to the feedback itself
     *
     * @param $feedbackId
     * @param Requests\CreateProductRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($feedbackId, Requests\CreateProductRequest $request)
    {
        Feedback::findOrFail($feedbackId)->update($request->all());
        Flash::message('The product has been listed successfully');
        return redirect("admins/feedback/{$feedbackId}");
    }


    /**
     * Update the Resolved field of the Feedback
     *
     * @param $feedbackId
     * @param Request $request
     * @return string
     */
    /*public function ajaxResolved($feedbackId, Request $request)
    {
        $feedback = Feedback::find($feedbackId);
        $feedback->resolved = $request->has('resolved');
        $feedback->save();
        return "Passed";
    }*/


    /*public function ajaxClosed($feedbackId, Request $request)
    {
        $feedback = Feedback::find($feedbackId);
        $feedback->closed = $request->has('closed');
        $feedback->save();
        return "Passed";
    }*/

    public function ajaxPatch($feedbackId, Request $request)
    {
        // dd($request->all());
        $field = $request->get('field');
        $value = $request->has($field);

        $feedback = Feedback::find($feedbackId);
        $feedback->$field = $value;
        if ($field == "closed")
            $feedback->closed_at = time();
        $feedback->save();
        return "Passed";
    }


    /**
     * Update the feedback by Ajaz request
     *
     * @param $feedbackId
     * @param $data
     * @return string
     */
    /*protected function ajaxUpdate($feedbackId, $data)
    {
        // The goal was to use the following ...

            // return $this->ajaxUpdate($productId, ['purchase' => $request->has('purchase')]);

        $feedback = Feedback::find($feedbackId);
        $feedback->update($data);
        return "Passed";
    }*/


    /**
     * Return a view with feedbacks filtered by the search query
     *
     * @param Request $request
     * @return $this
     */
    public function filtered(Request $request)
    {

        $feedbacks = new Feedback();
        $attributes = $feedbacks->getFillable();
        foreach ($request->all() as $field => $value)
        {
            if (in_array($field, $attributes))
                $feedbacks = $feedbacks->where($field, '=', $value);
        }
        $feedbacks = $feedbacks->orderBy('created_at', 'desc')->paginate(25);
        $feedbacks->appends($request->all());
        return $this->layout->content = view('admin.feedback.index')->with(compact('feedbacks'));

    }

}
