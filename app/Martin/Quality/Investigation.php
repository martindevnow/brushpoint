<?php namespace Martin\Quality;

use Martin\Core\CoreModel;

class Investigation extends CoreModel {

    protected $fillable = [
        'feedback_id',
        'user_id',
        'field_sample_requested_at',
        'field_sample_received_at'
    ];


    public function toggleFieldSampleReceived($status)
    {
        $this->field_sample_received = $status;
        if ($status)
            $this->field_sample_received_at = get_current_time();
        else
            $this->field_sample_received_at = 0;
        $this->save();
    }




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
