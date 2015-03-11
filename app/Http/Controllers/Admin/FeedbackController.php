<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Martin\Products\Feedback;

class FeedbackController extends Controller {


    public function index()
    {
        $feedbacks = Feedback::all();
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


    public function update($id)
    {
        $this->layout->content = view('admin.feedback.index');
    }

}
