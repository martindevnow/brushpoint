<?php namespace Martin\Quality;

use Martin\Core\CoreModel;
use Martin\Core\Traits\RecordsActivity;

class Email extends CoreModel {

    use RecordsActivity;
    
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
