<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Martin\Quality\Feedback;

class SearchController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

	}

	public function show(Request $request)
    {
        $feedbacks = Feedback::search($request->search, 1)->paginate(20);


        //->get();

        // dd($feedbacks);
        return view('admin.search.results')->with(compact('feedbacks'));
    }

}
