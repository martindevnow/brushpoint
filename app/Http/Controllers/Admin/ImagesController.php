<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Martin\Core\Image;

class ImagesController extends Controller {

    public function download($id)
    {
        $image = Image::find($id);

        return Response::download(base_path() . $image->path);
    }
}
