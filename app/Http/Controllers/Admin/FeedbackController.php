<?php namespace App\Http\Controllers\Admin;


use App\Events\ContactCustomerIssued;
use App\Events\RequestForRetailerInfoIssued;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\CreateNewFeedbackRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Martin\Notifications\Flash;
use Martin\Quality\Contact;
use Martin\Quality\CustomerRequest;
use Martin\Quality\Feedback;
use Martin\Quality\Issue;
use Martin\Quality\Repositories\ContactRepository;
use Martin\Quality\Retailer;

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


    public function close($id)
    {
        $feedback = Feedback::find($id);

        $feedback->toggleClose();

        Flash::message('The feedback has been closed.');

        return redirect()->back();
    }

    /**
     * Show the form for creating a new Feedback entry.
     *
     * @return Response
     */
    public function create()
    {
        $retailers = Retailer::lists('name', 'id');
        $issues = Issue::lists('type', 'id');

        array_unshift($issues, "Select");
        array_unshift($retailers, "Select");

        return $this->layout->content = view('admin.feedback.create')
            ->with(compact('retailers', 'issues'));
    }


    /**
     * Store a new Feedback submitted by QA department
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateNewFeedbackRequest $request)
    {
        Validator::extend('sanitiseDate', function($attribute, $value, $parameters)
        {
            return sanitiseDate($value);
        });

        $validator = Validator::make($request->all(), [
            'received_at' => 'sanitiseDate'
        ], ['sanitise_date' => 'Please enter using format: mm/dd/yyyy']);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors()->all());
        }


        $data = $request->except('_token', 'received_at' // , 'issue_id', 'retailer_id'
            );
        $data['hash'] = str_random(32);


        $feedback = Feedback::create($data);
        $feedback->save();
        $feedback->created_at = Carbon::createFromFormat('m/d/Y', $request->received_at);
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
        $issues = Issue::lists('type', 'id');
        $retailers = Retailer::lists('name', 'id');

//        dd($feedback->addresses->first()->toString());

        array_unshift($issues, "Select");
        array_unshift($retailers, "Select");

        return $this->layout->content = view('admin.feedback.show')
            ->with(compact('feedback', 'issues', 'retailers'));
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
        $issues = Issue::lists('type', 'id');
        $retailers = Retailer::lists('name', 'id');

        array_unshift($issues, "Select");
        array_unshift($retailers, "Select");

        return $this->layout->content = view('admin.feedback.edit')
            ->with(compact('feedback', 'issues', 'retailers'));
    }


    /**
     * Save the changes to the feedback and redirect back to the feedback itself
     *
     * @param $feedbackId
     * @param Requests\CreateProductRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($feedbackId, Request $request)
    {
        Feedback::findOrFail($feedbackId)->update($request->all());

        Flash::message('The feedback has been updated.');

        return redirect("admins/feedback/{$feedbackId}");
    }


    /**
     * Designed for string or integer, NOT checkboxes (use ajaxToggle for that)
     *
     * @param $feedbackId
     * @param Request $request
     * @return string
     */
    public function ajaxPatch($feedbackId, Request $request)
    {
        $field = $request->get('field');
        $value = $request->get($field);

        $feedback = Feedback::find($feedbackId);

        if ($field == "closed")
            $feedback->toggleClose($request->has($field));
        else
            $feedback->$field = $value;
        $feedback->save();
        return "Passed";
    }

    /**
     * Designed for Checkboxes (Boolean toggling)
     *
     * @param $feedbackId
     * @param Request $request
     * @return string
     */
    public function ajaxToggle($feedbackId, Request $request)
    {
        $field = $request->get('field');
        $value = $request->has($field);

        $feedback = Feedback::find($feedbackId);

        if ($field == "closed")
            $feedback->toggleClose($value);
        else
            $feedback->$field = $value;
        $feedback->save();
        return "Passed";
    }


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


    public function removeRetailer($feedbackId)
    {
        $feedback = Feedback::findOrFail($feedbackId);
        $feedback->retailer_id = null;
        $feedback->save();
        return redirect('/admins/feedback/'. $feedbackId);
    }


    public function removeIssue($feedbackId)
    {
        $feedback = Feedback::findOrFail($feedbackId);
        $feedback->issue_id = null;
        $feedback->save();
        return redirect('/admins/feedback/'. $feedbackId);
    }


    public function contactCustomer(Request $request, ContactRepository $contactRepository)
    {
        $feedback = Feedback::find($request->feedback_id);

        // put the values into the form
        $data['to_email'] = $contactRepository->getToEmail($feedback);
        $data['subject'] = $contactRepository->getSubject($feedback);
        $data['title'] = $contactRepository->getTitle();
        $data['from_email'] = $contactRepository->getFromEmail();
        $data['feedback_id'] = $feedback->id;

        $custRequest = CustomerRequest::create($request->except(
            'explain_interdental_arm',
            'explain_replacement_heads_usage',
            'explain_where_to_buy',
            'explain_how_to_change_batteries'
        ));

        $custRequest->hash = str_random(32);
        $custRequest->sent_at = get_current_time();
        $custRequest->save();


        // Tie up relationships
        Auth::user()->customerRequests()->save($custRequest);


        $data['customer_request_id'] = $custRequest->id;


        // get the body of the email based on the request
        $data['email_body'] = $contactRepository->getBody($request, $feedback, $custRequest);


        // display the form
        return $this->layout->content = view('admin.feedback.prepareContact')->with($data);
    }


    public function sendContactCustomer(Request $request)
    {
        // get request
        $data['to_email'] = $request->to_email;
        $data['from_email'] = $request->from_email;
        $data['subject'] = $request->subject;
        $data['body'] = $request->email_body;
        $data['feedback_id'] = $request->feedback_id;
        $data['email_template'] = 'emails.customer.genericContact';

        // build contact model
        $contact = Contact::create($data);

        // update the sent time for the customerRequest
        $customerRequest = CustomerRequest::find($request->customer_request_id);
        $customerRequest->sent_at = get_current_time();

        // tie the relationships
        Auth::user()->contacts()->save($contact);
        $contact->customerRequest()->save($customerRequest);

        // send model to email event
        event(new ContactCustomerIssued($contact, $customerRequest));

        // TODO: build a listener for this and send off the email
        Flash::message('Your email was sent successfully.');

        // associate the admin user to the contact that was sent
        Auth::user()->contacts()->save($contact);

        return redirect('/admins/feedback/'. $request->feedback_id);
    }



    public function destroy($id)
    {
        $feedback = Feedback::find($id);
        $feedback->trash();
        Flash::message('That feedback was deleted.');

        return redirect('admins/feedback/');
    }
}
