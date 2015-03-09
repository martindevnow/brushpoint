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
    public function index($id)
    {
        //
        return view('pages.index'.$id);
    }

    public function about()
    {
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
