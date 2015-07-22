<?php namespace Martin\Core;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model {

    protected $table = 'activities';

    protected $fillable = [
        'user_id',
        'subject_id',
        'subject_type',
        'name'
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