<?php namespace Martin\Quality;

use Illuminate\Database\Eloquent\Model;
use Martin\Core\CoreModel;

class CustomerRequest extends CoreModel {

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


    protected $dates = [
        'sent_at',
        'received_at',
    ];



    public function getValidationRules()
    {
        $validationRules = array();
        if ($this->request_lotcode)
            $validationRules['lot_code'] = "required";
        if ($this->request_retailer)
            $validationRules['retailer_text'] = "required";
        if ($this->request_image)
            $validationRules['product_image'] = "required";
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

    public function user()
    {
        return $this->belongsTo('Martin\Users\User');
    }


    public function feedback()
    {
        return $this->belongsTo('Martin\Quality\Feedback');
    }


    public function contact()
    {
        return $this->belongsTo('Martin\Quality\Contact');
    }
}
