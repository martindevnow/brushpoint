<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Martin\Notifications\Flash;
use Martin\Products\Feedback;

class FeedbackController extends Controller {


    public function index()
    {
        $feedbacks = Feedback::orderBy('created_at', 'desc')->paginate(25);
        $this->layout->content = view('admin.feedback.index')->with(compact('feedbacks'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        // show the form for submitting a complaint
        $this->layout->content = view('admin.feedback.create');
    }

    public function store(Request $request)
    {

        // $this->layout->content = view('admin.feedback.index');
    }


    public function show($id)
    {
        $feedback = Feedback::find($id);

        $this->layout->content = view('admin.feedback.show')->with(compact('feedback'));
    }


    public function edit($id)
    {
        $feedback = Feedback::find($id);
        $this->layout->content = view('admin.feedback.edit')->with(compact('feedback'));
    }


    public function update($id, Requests\CreateProductRequest $request)
    {

        Feedback::findOrFail($id)->update($request->all());

        Flash::message('The product has been listed successfully');

        return redirect("admins/feedback/{$id}");
    }

    public function ajaxResolved($feedbackId, Request $request)
    {
        $feedback = Feedback::find($feedbackId);
        $feedback->resolved = $request->has('resolved');
        $feedback->save();
        return "Passed";
    }


    protected function ajaxUpdate($feedbackId, $data)
    {
        // The goal was to use the following ...
        /*
         * return $this->ajaxUpdate($productId, ['purchase' => $request->has('purchase')]);
         */
        $feedback = Feedback::find($feedbackId);
        $feedback->update($data);
        dd($feedback);
        return "Passed";
    }

}
