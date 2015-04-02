<?php namespace Martin\Quality;

use Martin\Core\CoreModel;

class Issue extends CoreModel {

    protected $fillable = [
        'type',
        'complaint'
    ];

	public function feedbacks()
    {
        return $this->hasMany('Martin\Quality\Feedback');
    }


}
