<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class IssuesController extends Controller {

	public function ajaxStore(Request $request)
    {
        $type = $request->type;
        $complaint = $request->has('complaint');

        $issue = Issue::create([
            'type' => $type,
            'complaint' => $complaint
        ]);

        Feedback::find($request->feedback_id)->issue()->save($issue);

        return "passed";
    }

}
