<?php namespace Martin\Quality;

use Martin\Core\CoreModel;

class Investigation extends CoreModel {

    protected $fillable = [
        'feedback_id',
        'user_id',
        'field_sample_requested_at',
        'field_sample_received_at'
    ];

    protected $dates = [
        'field_sample_requested_at',
        'field_sample_received_at',
    ];


    /**
     * Toggle the value of field_sample_received and set the time it was toggled.
     *
     * @param $status
     */
    public function toggleFieldSampleReceived($status)
    {
        $this->field_sample_received = $status;
        if ($status)
            $this->field_sample_received_at = get_current_time();
        else
            $this->field_sample_received_at = 0;
        $this->save();
    }


    /**
     * This Investigation belongs to a single feedback
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function feedback()
    {
        return $this->belongsTo('Martin\Quality\Feedback');
    }

    /**
     * This investigation is opened by one user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('Martin\Users\User');
    }

    /**
     * This investigation MAY have many investigation reports.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function investigationReports()
    {
        return $this->hasMany('Martin\Quality\InvestigationReport');
    }

}
