<?php namespace Martin\Quality;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Martin\Core\CoreModel;
use Martin\Core\Traits\RecordsActivity;
use Martin\Reports\Reporter;

class CustomerRequest extends CoreModel {

    /**
     * Keep track of activity happening to this model
     */
    use RecordsActivity;


    /**
     * Make a new Activity when ...
     * CustomerRequest is [created, updated, or deleted]
     *
     * @var array
     */
    protected $recordEvents = ['created', 'updated', 'deleted'];

    /**
     * Make new Attentions when ...
     * Feedback is updated.
     *
     * @var array
     */
    protected $drawAttentionEvents = ['updated'];

    /**
     * Don't delete anything permanently
     */
    use SoftDeletes;

    /**
     * Make this class reportable
     */
    use Reporter;

    /**
     * Fields which may be mass-assigned
     *
     * @var array
     */
    protected $fillable = [
        'feedback_id',
        'contact_id',
        'user_id',

        'hash',
        'brush_type',

        'request_lot_code',
        'request_address',
        'request_retailer',
        'request_image',
        'request_field_sample',

        'sent_at',
        'received_at',
    ];

    /**
     * Other dates stored on this table
     *
     * @var array
     */
    protected $dates = [
        'sent_at',
        'received_at',
    ];


    /**
     * Return the array of validation rules
     * based on what info is requested.
     *
     * @return array
     */
    public function getValidationRules()
    {
        $validationRules = array();
        if ($this->request_lotcode)
            $validationRules['lot_code'] = "required";
        if ($this->request_retailer)
            $validationRules['retailer_text'] = "required";
        if ($this->request_image)
            $validationRules['product_image'] = "requiredimage";
        if ($this->request_field_sample || $this->request_address)
        {
            $validationRules['street_1'] = "required";
            $validationRules['city'] = "required";
            $validationRules['province'] = "required";
            $validationRules['postal_code'] = "required";
            $validationRules['country'] = "required";
        }
        return $validationRules;

    }


    /**
     * Trash this instance of the CustomerRequest model
     *
     * @return bool|\Illuminate\Database\Eloquent\Relations\MorphMany|null
     * @throws \Exception
     */
    public function trash()
    {
        $this->delete();
        return true;
    }

    /*
     * Relationships ===
     */

    /**
     * This CustomerRequest is opened by a user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('Martin\Users\User');
    }

    /**
     * This customerRequest is tied toa feedback
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function feedback()
    {
        return $this->belongsTo('Martin\Quality\Feedback');
    }

    /**
     * This CustomerRequest is owned by a Contact
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contact()
    {
        return $this->belongsTo('Martin\Quality\Contact');
    }
}
