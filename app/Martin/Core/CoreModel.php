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
        // Addresses
        $addresses = $this->addresses;
        foreach($addresses as $address)
            $address->trash();

        // Attentions
        $attentions = $this->attentions;
        foreach($attentions as $attention)
            $attention->trash();

        // Attachments
        $attachments = $this->attachments;
        foreach($attachments as $attachment)
            $attachment->trash();

//        // Comments
//        $comments = $this->comments;
//        foreach($comments as $comment)
//            $comment->trash();

        // Images
        $images = $this->images;
        foreach($images as $image)
            $image->trash();

        // Notes
        $notes = $this->notes;
        foreach($notes as $note)
            $note->trash();
    }
}