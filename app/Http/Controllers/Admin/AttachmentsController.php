<?php namespace App\Http\Controllers\Admin;

use App\Commands\UploadAttachmentCommand;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Log;


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
    //    $result = $this->dispatch(new UploadAttachmentCommand($request));
        $result = $this->uploadAttachment($request);

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
    
    public function uploadAttachment($request) {

        $this->validate($request,[
            'attachment_file' => 'required'
        ]);

        $class = $request->attachmentable_class;
        $model = new $class;
        $model = $model->findOrFail($request->attachmentable_id);

        if ($request->hasFile('attachment_file'))
        {
	Log::info('it has an attachemnt');
            
	Log::info(ini_get('upload_tmp_dir'));
	$shortPath = config('brushpoint.attachment_storage_path');
            $fullPath = base_path() . $shortPath ;

            $attachment = new Attachment();
            $attachment->content = $request->body;
            $attachment->save();


            $attachment_name = $attachment->id . '.' .
                $request->file('attachment_file')->getClientOriginalExtension();


            $attachment->file_name = $request->file('attachment_file')->getClientOriginalName();
            $attachment->file_path = $shortPath . $attachment_name;
            $attachment->file_extension = $request->file('attachment_file')->getClientOriginalExtension();
            $attachment->save();

            $request->file('attachment_file')->move(
                $fullPath, $attachment_name
            );

            \Auth::user()->attachments()->save($attachment);

            $model->attachments()->save($attachment);

            return true;
       }
        return false;



    }


}
