<?php namespace App\Http\Controllers;

use App\Events\CustomerFeedbackSubmitted;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\GetAddressRequest;
use App\Http\Requests\SendFeedbackRequest;
use Illuminate\Http\Request;
use Martin\Core\Image;
use Martin\Notifications\Flash;
use Martin\Quality\Feedback;

class FeedbackController extends Controller {

    /**
     * Show the form for creating a new feedback submission.
     *
     * @return Response
     */
    public function create()
    {
        // show the form for submitting a complaint
        return view('feedback.create');
    }


    /**
     * Submit the feedback to the server and save it
     *
     * @param SendFeedbackRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function send(SendFeedbackRequest $request)
    {
        $data = $request->only('name', 'email', 'phone', 'issue_text', 'intent');
        $data['hash'] = str_random(32);

        $feedback = Feedback::create($data);

        event(new CustomerFeedbackSubmitted($feedback));

        Flash::message('Your feedback has been received!');

        return redirect('feedback/thankyou');
    }


    /**
     * Display the form to enter the address to send a replacement toothbrush
     *
     * @param $id
     * @param $hash
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function createAddress($id, $hash)
    {
        $feedback = Feedback::findOrFail($id);

        if ($hash == $feedback->hash)
            return view('feedback.address')->with(compact('feedback'));
        else
            return redirect('/');

    }

    /**
     * Save the address entered to the feedback it is related to
     *
     * @param GetAddressRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function storeAddress($id, $hash, GetAddressRequest $request)
    {
        $feedback = Feedback::findOrFail($id);

        if ($feedback->hash != $hash)
            return redirect('/');

        $data = $request->only('street_1', 'street_2', 'city', 'province', 'postal_code', 'country');

        $data['name'] = $feedback->name;

        $feedback->addresses()->create($data);

        Flash::message('Your message has been sent!');

        // create event?
        // send email to the user?
        return redirect('feedback/thankyou');

    }

    /**
     * Display a simple thank you page
     *
     * @return \Illuminate\View\View
     */
    public function thankyou()
    {
        return view('feedback.thankyou');
    }



    public function editCustomerRequest($feedbackId, $customerRequestId, $customerRequestHash)
    {
        $feedback = Feedback::findOrFail($feedbackId);

        $customerRequest = $feedback->customerRequests->where('id', (int) $customerRequestId)->first();

        if ($customerRequest->hash != $customerRequestHash)
            return redirect('/');

        return view('feedback.editCustomerRequest')
            ->with(compact('feedback', 'customerRequest'));
    }


    /**
     * @param $feedbackId
     * @param $customerRequestId
     * @param $customerRequestHash
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function storeCustomerRequest($feedbackId, $customerRequestId, $customerRequestHash, Request $request)
    {
        $feedback = Feedback::findOrFail($feedbackId);

        $customerRequest = $feedback->customerRequests->where('id', (int) $customerRequestId)->first();

        if ($customerRequest->hash != $customerRequestHash)
            return redirect('/');

        $validationRules = $customerRequest->getValidationRules();
        $this->validate($request, $validationRules);

        // Save the address (if requested)
        if ($customerRequest->request_address || $customerRequest->request_field_sample)
        {
            $addressData = $request->only('street_1', 'street_2', 'city', 'province', 'postal_code', 'country');
            $addressData['name'] = $feedback->name;
            $feedback->addresses()->create($addressData);
        }

        // save the Lot code/retailer (if requested)
        $feedback->lot_code = $request->lot_code;
        $feedback->retailer_text = $request->retailer_text;
        $feedback->save();


        if ($customerRequest->request_image)
        {
            $imageName = $customerRequest->id . '.' .
                $request->file('product_image')->getClientOriginalExtension();

            $shortPath = config('brushpoint.customer_submitted_images_storage_path');
            $fullPath = base_path() . $shortPath ;

            $request->file('product_image')->move(
                $fullPath, $imageName
            );

            $image = new Image();
            $image->file_name = $request->file('product_image')->getClientOriginalName();
            $image->file_path = $shortPath . $imageName;
            $image->path = $shortPath . $imageName;
            $image->save();

            $customerRequest->images()->save($image);
        }

        $customerRequest->received_at = get_current_time();
        $customerRequest->save();

        Flash::message('Thank you for your submission!');

        return redirect('feedback/thankyou');

    }
}
