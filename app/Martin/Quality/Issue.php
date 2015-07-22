<?php namespace Martin\Quality;

use Martin\Core\CoreModel;
use Martin\Core\Traits\RecordsActivity;

class Issue extends CoreModel {

    use RecordsActivity;

    protected $fillable = [
        'type',
        'complaint'
    ];

	public function feedbacks()
    {
        return $this->hasMany('Martin\Quality\Feedback');
    }


}
