<?php

namespace Martin\Core;

use Illuminate\Database\Eloquent\Model;

class CoreModel extends Model{

    public function notes()
    {
        return $this->morphMany('Martin\Core\Note', 'noteable');
    }

    public function addresses()
    {
        return $this->morphMany('Martin\Core\Address', 'addressable');
    }

    public function comments()
    {
        return $this->morphMany('Martin\Core\Comment', 'commentable');
    }

    public function images()
    {
        return $this->morphMany('Martin\Core\Image', 'imageable');
    }
}