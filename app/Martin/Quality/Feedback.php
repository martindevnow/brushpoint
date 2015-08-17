<?php namespace Martin\Quality;

use DateTime;
use Martin\Core\CoreModel;
use Martin\Core\Traits\DrawsAttention;
use Martin\Core\Traits\RecordsActivity;
use Martin\Reports\Reporter;

class Feedback extends CoreModel {

    use RecordsActivity;

    protected $recordEvents = ['created', 'updated'];
    protected $drawAttentionEvents = ['created', 'updated'];


    use Reporter;

    protected $table = 'feedbacks';

    protected $fillable = [
        'name',
        'email',
        'phone',

        'retailer_text',
        'retailer_id',
        'retailer_reference',

        'lot_code',

        'issue_text',
        'issue_id',

        'hash',
        'intent',

        'bp_code',
        'ip_address',
        'country',

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

    /**
     * Return the name of the issue
     *
     * @return mixed
     */
    public function getIssueTypeAttribute()
    {
        if ($this->issue_id)
        {
            $issue = Issue::find($this->issue_id);
            return $issue->type;
        }
        return $this->issue_text;
    }


    public function getRetailerNameAttribute()
    {
        if ($this->retailer_id)
        {
            $retailer = Retailer::find($this->retailer_id);
            return $retailer->name;
        }
        return $this->retailer_text;
}



    public function getNumberOfDaysOpenAttribute()
    {
        if (! $this->closed)
            return "OPEN";

        $laterDate = $this->closed_at;
        $earlierDate = $this->created_at;
        if ($laterDate)
            return $earlierDate->diffInDays($laterDate);
        else
            return "N/A";
    }


    // TODO: Must add in this functionality
    public function getOnTimeClosingAttribute()
    {
        return "IDONTKNOW";
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
        if (! $this->attentions->isEmpty())
            foreach($this->attentions as $attention)
                if ($attention->seen)
                    return true;
        return false;
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
        return $this->hasOne('Martin\Core\Address', 'id', 'address_id');
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