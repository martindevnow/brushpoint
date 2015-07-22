<?php namespace Martin\Core;

use Illuminate\Database\Eloquent\Model;
use Martin\Core\Traits\RecordsActivity;

class Attachment extends Model {

    use RecordsActivity;

	protected $table = 'attachments';

    protected $fillable = [

    ];

    protected $hidden = [];

    public function attachmentable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo('Martin\Users\User');
    }


    public function download()
    {
        return response()->download(base_path(). $this->file_path, $this->file_name);
    }


}
