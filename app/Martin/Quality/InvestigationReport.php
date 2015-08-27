<?php namespace Martin\Quality;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Response;
use Martin\Core\CoreModel;
use Martin\Core\Traits\RecordsActivity;

class InvestigationReport extends CoreModel {

    use RecordsActivity;
    use SoftDeletes;

    protected $fillable = [
        'investigation_id',
        'user_id',
        'file_name',
        'file_extension',
        'short_description',
    ];


    public function download()
    {
        return response()->download(base_path(). $this->file_path, $this->file_name);
    }


    public function investigation()
    {
        return $this->belongsTo('Martin\Quality\Investigation');
    }


    public function user()
    {
        return $this->belongsTo('Martin\Users\User');
    }

}
