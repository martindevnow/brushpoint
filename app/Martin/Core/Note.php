<?php namespace Martin\Core;

use Illuminate\Database\Eloquent\Model;
use Martin\Core\Traits\RecordsActivity;

class Note extends Model {

    use RecordsActivity;

    protected static $recordEvents = ['created'];

    protected $table = 'notes';

    protected $fillable = [
        'user_id',
        'content'
    ];

    protected $hidden = [];

    public function noteable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo('Martin\Users\User');
    }


} 