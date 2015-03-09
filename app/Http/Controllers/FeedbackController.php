<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

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


}
