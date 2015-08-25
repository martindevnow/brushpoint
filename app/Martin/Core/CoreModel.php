<?php

namespace Martin\Core;

use App\Exceptions\UserNotLoggedIn;
use Illuminate\Database\Eloquent\Model;

class CoreModel extends Model{

    public function requestDelete($reason = "Just because...")
    {
        if (! \Auth::id() )
            throw new UserNotLoggedIn("User must be logged in");
        $model = $this;
        $trash = new Trash();
        $trash->reason = $reason;
        $trash->user_id = \Auth::id();
        $model->trash()->save($trash);
        return $model;
    }


    public function notes()
    {
        return $this->morphMany('Martin\Core\Note', 'noteable');
    }

    public function attentions()
    {
        return $this->morphMany('Martin\Core\Attention', 'attentionable');
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

    public function attachments()
    {
        return $this->morphMany('Martin\Core\Attachment', 'attachmentable');
    }

    public function trash()
    {
        return $this->morphMany('Martin\Core\Trash', 'trashable');
    }
}