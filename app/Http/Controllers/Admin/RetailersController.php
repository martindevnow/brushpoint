<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Martin\Quality\Feedback;
use Martin\Quality\Retailer;

class RetailersController extends Controller {

    public function index()
    {
        $retailers = Retailer::all();
        return view('admin.retailers.index')->withRetailers($retailers);
    }

    public function show($retailerId)
    {
        $retailer = Retailer::find($retailerId);

        return view('admin.retailers.show')->withRetailer($retailer);

    }

    /**
     * @param Request $request
     * @return string
     */
    public function ajaxStore(Request $request)
    {
        $feedback = Feedback::find($request->feedback_id);

        // WILL allow overwriting a feedback's Retailer

        $name = $request->name;

        $retailer = Retailer::firstOrCreate([
            'name' => $name,
            'description' => '',
            'active' => 1
        ]);

        $retailer->feedbacks()->save($feedback);

        return "passed";
    }


    public function ajaxPatch($issueId, Request $request)
    {
        $field = $request->get('field');
        $value = $request->has($field);

        $issue = Retailer::find($issueId);
        $issue->$field = $value;
        $issue->save();
        return "Passed";
    }

}
