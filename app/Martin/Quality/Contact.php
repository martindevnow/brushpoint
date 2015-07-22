<?php namespace Martin\Quality;

use Illuminate\Database\Eloquent\Model;
use Martin\Core\Traits\RecordsActivity;

class Contact extends Model {

    use RecordsActivity;

	protected $fillable = [
        'email_template',

        'to_email',
        'from_email',

        'subject',
        'body',

        'user_id',
        'feedback_id',
    ];

    protected $table = 'contacts';


    public function feedback()
    {
        return $this->belongsTo('Martin\Quality\Feedback');
    }

    public function user()
    {
        return $this->belongsTo('Martin\Users\User');
    }

    public function customerRequest()
    {
        return $this->hasOne('Martin\Quality\CustomerRequest');
    }


}
