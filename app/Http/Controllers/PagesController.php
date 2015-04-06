<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Martin\Notifications\Flash;

class PagesController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('pages.index2');
    }

    public function about()
    {
        // $this->layout->content = view('pages.about');
        return view('pages.about');
    }

    public function capabilities()
    {
        return view('pages.capabilities');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function sendContact(Requests\SendContactRequest $request)
    {
        $data = $request->only('name', 'email', 'user_message');

        Mail::send('emails.contact', $data, function($message) use ($data)
            {
                $message->from($data['email'], $data['name']);
                $message->to('benjaminm@brushpoint.com', 'Admin')
                    ->subject('Contact from '. $data['name']);
            });

        Flash::message('Your message has been delivered!');

        return redirect('contact/thankyou');
    }

    public function thankyouContact()
    {
        return view('pages.contact_thankyou');
    }

    public function video()
    {
        return view('pages.video');
    }

}
