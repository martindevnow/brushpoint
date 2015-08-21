<?php namespace Martin\Quality;

use Martin\Core\CoreModel;
use Martin\Core\Traits\RecordsActivity;

class Email extends CoreModel {

    protected $table = 'emails';

	protected $fillable = [
        'email_type',
        'recipient_list',
    ];


    public function setRecipientListAttribute($value)
    {
        $this->attributes['recipient_list'] = serialize($value);
    }

    public function getRecipientListAttribute($value)
    {
        return unserialize($value);
    }


}
