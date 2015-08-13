<?php namespace Martin\Quality;

use DateTime;
use Martin\Core\CoreModel;
use Martin\Core\Traits\DrawsAttention;
use Martin\Core\Traits\RecordsActivity;

class Feedback extends CoreModel {

    use RecordsActivity;

    // use DrawsAttention;
    protected $drawAttentionEvents = ['created', 'updated'];

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
        'intent',

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
    ];

    protected $dates = [
        'closed_at',
    ];


    public function toggleClose($status)
    {
        // $status = ($this->closed + 1) % 2;
        $this->closed = $status;
        if ($status)
            $this->closed_at = get_current_time();
        else
            $this->closed_at = 0;
        $this->save();
    }




    public function setRetailerIdAttribute($id)
    {
        if ($id == 0)
            $this->attributes['retailer_id'] = null;
        else
            $this->attributes['retailer_id'] = $id;
    }

    public function setIssueIdAttribute($id)
    {
        if ($id == 0)
            $this->attributes['issue_id'] = null;
        else
            $this->attributes['issue_id'] = $id;
    }


    public function isUnseen()
    {
        if ($this->attentions)
        {
            dd($this->attentions);
        }
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

    public function address()
    {
        return $this->hasOne('Martin\Core\Address');
    }

    public function emails()
    {
        return $this->hasMany('Martin\Quality\Email');
    }

    public function contacts()
    {
        return $this->hasMany('Martin\Quality\Contact');
    }

    public function customerRequests()
    {
        return $this->hasMany('Martin\Quality\CustomerRequest');
    }






} 