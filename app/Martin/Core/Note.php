<?php namespace Martin\Core;

use Illuminate\Database\Eloquent\Model;

class Note extends Model {

    protected $table = 'addresses';

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