<?php namespace Martin\Quality;

use Illuminate\Database\Eloquent\Model;

class Email extends CoreModel {

    protected $table = 'emails';
	protected $fillable = [
        'body',
        'subject',
        'template',
        'recipient_email',
        'feedback_id',
    ];

    public function feedback()
    {
        return $this->belongsTo('Martin\Quality\Feedback');
    }

}
