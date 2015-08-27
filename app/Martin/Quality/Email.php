<?php namespace Martin\Quality;

use Illuminate\Database\Eloquent\SoftDeletes;
use Martin\Core\CoreModel;
use Martin\Core\Traits\RecordsActivity;

class Email extends CoreModel {
    use SoftDeletes;

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
