<?php namespace Martin\Core;

use Illuminate\Database\Eloquent\Model;

class Image extends Model {

    protected $table = 'images';

    protected $fillable = [
        'user_id',
        'content',
        'height',
        'width',
        'path',
        'thumbnail'
    ];

    protected $hidden = [];

    public function imageable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo('Martin\Users\User');
    }
} 