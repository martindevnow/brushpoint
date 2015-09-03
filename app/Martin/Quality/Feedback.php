<?php namespace Martin\Quality;

use DateTime;
use Illuminate\Database\Eloquent\SoftDeletes;
use Martin\Core\CoreModel;
use Martin\Core\Traits\DrawsAttention;
use Martin\Core\Traits\RecordsActivity;
use Martin\Reports\Reporter;
use Nicolaslopezj\Searchable\SearchableTrait;

class Feedback extends CoreModel {

    /**
     * Keep track of activity happening to this model
     */
    use RecordsActivity;

    /**
     * Make new Attentions when ...
     * Feedback is created, updated or deleted.
     *
     * @var array
     */
    protected $drawAttentionEvents = ['created', 'updated'];

    /**
     * Make a new Activity when ...
     * Feedback is created/updated/deleted
     *
     * @var array
     */
    protected $recordEvents = ['created', 'updated', 'deleted'];

    /**
     * Don't delete anything permanently
     */
    use SoftDeletes;

    /**
     * Make this class reportable
     */
    use Reporter;

    public $reporterFields = array(
        'id',
        'created_at',
        'name',
        'addresses.firstRecord',
        'phone',
        'bp_code',
        'retailer_name',
        'intent',
        'lot_code',
        'issue_type',
        'adverse_event',
        'RESOLUTION',
        'health_canada_report',
        'capa_required',
        'capa_reaspn',
        'closed',
        'closed_at',
        'number_of_days_open',
        'on_time_closing');

    /**
     * Database table name
     *
     * @var string
     */
    protected $table = 'feedbacks';

    /**
     * Fields which may be mass-assigned
     *
     * @var array
     */
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

    /**
     * Other dates stored on this table
     *
     * @var array
     */
    protected $dates = [
        'closed_at',
    ];

    /**
     * Make this class searchable
     */
    use SearchableTrait;

    /**
     * Weights for searching this table
     *
     * @var array
     */
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

    /**
     * Toggle the close/open status
     *
     * @param $status
     */
    public function toggleClose($status = 2)
    {
        if ($status == 2)
            $status = ($this->closed + 1) % 2;

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


    /**
     * Return the retailer name for this feedback
     *
     * @return mixed
     */
    public function getRetailerNameAttribute()
    {
        if ($this->retailer_id)
        {
            $retailer = Retailer::find($this->retailer_id);
            return $retailer->name;
        }
        return $this->retailer_text;
}


    /**
     * Return the number of days open
     *
     * @return string
     */
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

    /**
     * Tests to see if the
     *
     * @return bool
     */
    public function getOnTimeClosingAttribute()
    {
        // normal = 30 days max
        // adverse event = 15
        // with field samples += 15 days extra.

        $numDaysOpen = $this->getNumberOfDaysOpenAttribute();
        if (! is_int($numDaysOpen))
            return false;

        $maxDaysOpen = 0;

        if ($this->fieldSampleRequested())
            $maxDaysOpen += 15;

        if ($this->adverse_event)
            $maxDaysOpen += 15;
        else
            $maxDaysOpen += 30;

        if ($numDaysOpen <= $maxDaysOpen)
            return true;

        return false;
    }

    /**
     * Attribute Mutator
     * to prevent 0 being assigned to the retailer_id field
     *
     * @param $id
     */
    public function setRetailerIdAttribute($id)
    {
        if ($id == 0)
            $this->attributes['retailer_id'] = null;
        else
            $this->attributes['retailer_id'] = $id;
    }

    /**
     * Attribute Mutator
     * to prevent 0 being assigned as the issue_id
     *
     * @param $id
     */
    public function setIssueIdAttribute($id)
    {
        if ($id == 0)
            $this->attributes['issue_id'] = null;
        else
            $this->attributes['issue_id'] = $id;
    }

    /**
     * Is this feedback unseen
     *
     * @return bool
     */
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

        // Contacts
        $contacts = $this->contacts;
        foreach($contacts as $contact)
            $contact->trash();

        // CustomerRequests
        $customerRequests = $this->customerRequests;
        foreach($customerRequests as $customerRequest)
            $customerRequest->trash();

        // finally, kill this one
        $this->delete();
    }


    public function fieldSampleRequested()
    {
        $requests = $this->customerRequests;
        foreach ($requests as $request)
            if ($request->request_field_sample)
                return true;
        return false;
    }

    /*
     * Relationships
     */

    /**
     * This feedback has one issue
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function issue()
    {
        return $this->belongsTo('Martin\Quality\Issue');
    }

    /**
     * This Feedback can have more than 1 investigation
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function investigations()
    {
        return $this->hasMany('Martin\Quality\Investigation');
    }

    /**
     * This Feedback is related to one retailer
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function retailer()
    {
        return $this->belongsTo('Martin\Quality\Retailer');
    }

    /**
     * This Feedback has one address tied to it.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function address()
    {
        return $this->hasOne('Martin\Core\Address', 'id', 'address_id');
    }

    /**
     * This Feedback has many contacts
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contacts()
    {
        return $this->hasMany('Martin\Quality\Contact');
    }

    /**
     * This Feedback has many customer Requests
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function customerRequests()
    {
        return $this->hasMany('Martin\Quality\CustomerRequest');
    }
}