<?php namespace Martin\Quality;

use Martin\Core\CoreModel;

class Investigation extends CoreModel {

    protected $fillable = [
        'field_sample_requested_at',
        'field_sample_received_at'
    ];

    public function feedback()
    {
        return $this->belongsTo('Martin\Quality\Feedback');
    }

}
