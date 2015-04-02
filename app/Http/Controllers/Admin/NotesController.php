<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Martin\Core\Note;

class NotesController extends Controller {

	public function ajaxStore(Request $request)
    {
        $class = $request->class;
        $model = new $class;

        $model = $model::find($request->noteable_id);

        $model->notes()->create([
            'content' => $request->content,
            'user_id' => \Auth::user()->id
        ]);

        return "passed";
    }

}
