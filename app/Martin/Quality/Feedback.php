<?php namespace Martin\Quality;

use DateTime;
use Illuminate\Database\Eloquent\SoftDeletes;
use Martin\Core\CoreModel;
use Martin\Core\Traits\DrawsAttention;
use Martin\Core\Traits\RecordsActivity;
use Martin\Reports\Reporter;
use Nicolaslopezj\Searchable\SearchableTrait;

class Feedback extends CoreModel {

    use RecordsActivity;
    use SoftDeletes;
    use SearchableTrait;

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


    protected $searchable = [
        'columns' => [
            'phone' => 50,
            'name' => 50,
            'email' => 50,
            'issue_text' => 50,
            'lot_code' => 50,
            'bp_code' => 50,
            'issues.type' => 50,
            'retailer_text' => 50,
            //'retailers.name' => 50,
        ],
        'joins' => [
            'issues' => ['feedbacks.issue_id', 'issues.id'],
           // 'retailers' => ['feedbacks.retailer_id', 'retailers.id'],
        ],
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


    /**
     * Trash this entry and delete the Attentions related to this model
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany|void
     */
    public function trash()
    {
        // Attentions
        $attentions = $this->attentions;
        foreach($attentions as $attention)
            $attention->trash();

        // Investigations
        $investigations = $this->investigations;
        foreach($investigations as $investigation)
            $investigation->trash();

        // Emails
        $emails = $this->emails;
        foreach($emails as $email)
            $email->trash();

        // Contacts
        $contacts = $this->contacts;
        foreach($contacts as $contact)
            $contact->trash();

        // CustomerRequests
        $customerRequests = $this->customerRequests;
        foreach($customerRequests as $customerRequest)
            $customerRequest->trash();
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