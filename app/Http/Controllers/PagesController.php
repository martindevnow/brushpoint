<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

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

    public function video()
    {
        return view('pages.video');
    }

}
