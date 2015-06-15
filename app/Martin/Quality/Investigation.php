<?php namespace Martin\Quality;

use Martin\Core\CoreModel;

class Investigation extends CoreModel {

    protected $fillable = [
        'feedback_id',
        'user_id',
        'field_sample_requested_at',
        'field_sample_received_at'
    ];

    public function feedback()
    {
        return $this->belongsTo('Martin\Quality\Feedback');
    }

    public function user()
    {
        return $this->belongsTo('Martin\Users\User');
    }

    public function investigationReports()
    {
        return $this->hasMany('Martin\Quality\InvestigationReport');
    }

}
