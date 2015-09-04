<?php namespace App\Http\Controllers\Admin;

use App\Commands\UploadAttachmentCommand;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Martin\Core\Attachment;
use Martin\Notifications\Flash;

class AttachmentsController extends Controller {

	public function ajaxStore(Request $request)
    {
        $class = $request->class;
        $model = new $class;

        $model = $model::find($request->noteable_id);

        $attachment = $model->notes()->create([
            'content' => $request->body,
            'user_id' => \Auth::user()->id
        ]);

        return view('admin.ajax.singles._attachment')->with(compact('note'));
    }



    public function attachmentStore(Request $request)
    {
        $result = $this->dispatch(new UploadAttachmentCommand($request));

        if ($result)
            Flash::message('Your attachment was uploaded.');
        else
            Flash::error("Your attachment could not be uploaded.");

        return redirect()->back();
    }

    public function attachmentDownload($attachmentId)
    {
        $attachment = Attachment::find($attachmentId);

        return $attachment->download();
    }

}
