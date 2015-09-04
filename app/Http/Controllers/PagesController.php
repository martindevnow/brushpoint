<?php namespace App\Http\Controllers;

use App\Events\CustomerContactedUs;
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
        return view('pages.index');
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
        return redirect('/feedback');
    }

       /**
     * Include the video of the vital health system and how to use it
     *
     * @return $this
     */
    public function video()
    {
        $vitalHealthDM = Product::findOrFail(1);

        return view('pages.video')->with(compact('vitalHealthDM'));
    }

}
