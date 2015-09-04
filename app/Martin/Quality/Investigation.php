<?php namespace Martin\Quality;

use Illuminate\Database\Eloquent\SoftDeletes;
use Martin\Core\CoreModel;
use Martin\Core\Traits\RecordsActivity;

class Investigation extends CoreModel {

    use RecordsActivity;
    use SoftDeletes;

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
     * Trash this Investigation and take all Reports with it!
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany|void
     */
    public function trash()
    {
        $reports = $this->investigationReports;
        foreach($reports as $report)
            $report->trash();
        return true;
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
