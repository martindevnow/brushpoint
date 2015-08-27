<?php namespace Martin\Quality;

use Illuminate\Database\Eloquent\SoftDeletes;
use Martin\Core\CoreModel;
use Martin\Core\Traits\RecordsActivity;

class Issue extends CoreModel {

    use RecordsActivity;
    use SoftDeletes;

    protected $fillable = [
        'type',
        'complaint'
    ];

	public function feedbacks()
    {
        return $this->hasMany('Martin\Quality\Feedback');
    }


}
