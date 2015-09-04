<?php namespace App\Commands;

use App\Commands\Command;

use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Martin\Core\Attachment;

class UploadAttachmentCommand extends Command implements SelfHandling {

    use ValidatesRequests;

    /**
     * @var Request
     */
    public $request;

    /**
     * Create a new command instance.
     *
     * @param Request $request
     * @return \App\Commands\UploadAttachmentCommand
     */
	public function __construct(Request $request)
	{
		//
        $this->request = $request;
    }

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
        $this->validate($this->request,[
            'attachment_file' => 'required'
        ]);

        $class = $this->request->attachmentable_class;
        $model = new $class;
        $model = $model->findOrFail($this->request->attachmentable_id);

        if ($this->request->hasFile('attachment_file'))
        {
            $shortPath = config('brushpoint.attachment_storage_path');
            $fullPath = base_path() . $shortPath ;

            $attachment = new Attachment();
            $attachment->content = $this->request->body;
            $attachment->save();


            $attachment_name = $attachment->id . '.' .
                $this->request->file('attachment_file')->getClientOriginalExtension();


            $attachment->file_name = $this->request->file('attachment_file')->getClientOriginalName();
            $attachment->file_path = $shortPath . $attachment_name;
            $attachment->file_extension = $this->request->file('attachment_file')->getClientOriginalExtension();
            $attachment->save();

            $this->request->file('attachment_file')->move(
                $fullPath, $attachment_name
            );

            Auth::user()->attachments()->save($attachment);

            $model->attachments()->save($attachment);

            return true;
        }
        return false;

    }

}
