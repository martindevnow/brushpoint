<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Martin\Quality\Feedback;
use Martin\Quality\Issue;

class IssuesController extends Controller {

    public function index()
    {
        $issues = Issue::all();
        return view('admin.issues.index')->withIssues($issues);
    }

    public function show($issueId)
    {
        $issue = Issue::find($issueId);

        return view('admin.issues.show')->withIssue($issue);

    }

    /**
     * @param Request $request
     * @return string
     */
	public function ajaxStore(Request $request)
    {
        $feedback = Feedback::find($request->feedback_id);

        // WILL allow overwriting a feedback's issue

        $type = $request->type;
        $complaint = $request->has('complaint');

        $issue = Issue::firstOrCreate([
            'type' => $type,
            'complaint' => $complaint
        ]);

        $issue->feedbacks()->save($feedback);

        return "passed";
    }


    public function ajaxPatch($issueId, Request $request)
    {
        $field = $request->get('field');
        $value = $request->has($field);

        $issue = Issue::find($issueId);
        $issue->$field = $value;
        $issue->save();
        return "Passed";
    }
}
