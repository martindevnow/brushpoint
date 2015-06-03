<?php namespace App\Http\Controllers;

use Martin\Quality\Contact;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Martin\Notifications\Flash;
use Martin\Products\Product;

class PagesController extends Controller {

    /**
     * Display the home page
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('pages.index2');
    }

    /**
     * Static page to show info about BrushPoint
     *
     * @return \Illuminate\View\View
     */
    public function about()
    {
        // $this->layout->content = view('pages.about');
        return view('pages.about');
    }

    /**
     * Static page to show BrushPoint capabilities
     *
     * @return \Illuminate\View\View
     */
    public function capabilities()
    {
        return view('pages.capabilities');
    }

    /**
     * Display the form for the user to message BrushPoint
     * @return \Illuminate\View\View
     */
    public function contact()
    {
        return view('pages.contact');
    }

    /**
     * Process the sending of the message from the user
     *
     * @param Requests\SendContactRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function sendContact(Requests\SendContactRequest $request)
    {
        $data = $request->only('name', 'email', 'user_message');
        $data['ip'] = $_SERVER['REMOTE_ADDR'];
        $data['message'] = $request->user_message;

        $contact = Contact::create($data);

        unset($data['message']);

        Mail::send('emails.contact', $data, function($message) use ($data)
        {
            $message->from($data['email'], $data['name']);
            $message->to('info@brushpoint.com', 'BrushPoint Info')
                ->subject('Contact from '. $data['name']);
        });

        Flash::message('Your message has been delivered!');

        return redirect('contact/thankyou');
    }

    /**
     * Show confirmation to the user that their message was sent
     *
     * @return \Illuminate\View\View
     */
    public function thankyouContact()
    {
        return view('pages.contact_thankyou');
    }

    /**
     * Include the video of the vital health system and how to use it
     *
     * @return $this
     */
    public function video()
    {
        $vitalHealthDM = Product::find(1);

        return view('pages.video')->with(compact('vitalHealthDM'));
    }

}
