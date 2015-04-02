<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Martin\Quality\Feedback;
use Martin\Quality\Issue;

class IssuesController extends Controller {

    public function index()
    {
        
    }

	public function ajaxStore(Request $request)
    {
        $type = $request->type;
        $complaint = $request->has('complaint');

        $issue = Issue::firstOrCreate([
            'type' => $type,
            'complaint' => $complaint
        ]);

        $feedback = Feedback::find($request->feedback_id);

        $issue->feedbacks()->save($feedback);

        return "passed";
    }

}
