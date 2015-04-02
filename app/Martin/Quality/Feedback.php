<?php namespace Martin\Quality;


use Martin\Core\CoreModel;

class Feedback extends CoreModel {

    protected $table = 'feedbacks';

    protected $fillable = [
        'name',
        'email',
        'phone',

        'retailer',
        'lot_code',
        'issue',
        'issue_id',

        'bp_code',
        'ip_address',
        'country',

        'retailer_id',
        'retailer_reference',

        'address_id',
        'adverse_event',
        'health_canada_report',
        'capa_required',
        'capa_reason',

        'closed',
        'closed_at',

        'resolved',

    ];


    public function issue()
    {
        return $this->belongsTo('Martin\Quality\Issue');
    }

    public function investigations()
    {
        return $this->hasMany('Martin\Quality\Investigation');
    }



} 