<?php namespace Martin\Quality;


use DateTime;
use Martin\Core\CoreModel;

class Feedback extends CoreModel {

    protected $table = 'feedbacks';

    protected $fillable = [
        'name',
        'email',
        'phone',

        'retailer',
        'lot_code',

        'issue_text',
        'issue_id',

        'hash',

        'bp_code',
        'ip_address',
        'country',

        'retailer_text',
        'retailer_id',
        'retailer_reference',

        'address_id',
        'adverse_event',
        'health_canada_report',
        'capa_required',
        'capa_reason',

        'closed',
        'closed_at',

        // Replaced by 'closed' field
        // 'resolved',

    ];


    public function toggleClose($status)
    {
        // $status = ($this->closed + 1) % 2;
        $this->closed = $status;
        $dt = new DateTime;
        if ($status)
            $this->closed_at = $dt->format('y-m-d H:i:s');
        else
            $this->closed_at = 0;
        $this->save();
    }




    public function issue()
    {
        return $this->belongsTo('Martin\Quality\Issue');
    }

    public function investigations()
    {
        return $this->hasMany('Martin\Quality\Investigation');
    }

    public function retailer()
    {
        return $this->belongsTo('Martin\Quality\Retailer');
    }




} 