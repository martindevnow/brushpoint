<?php namespace Martin\Core;

use Illuminate\Database\Eloquent\Model;

class Attention extends Model {

	protected $table = "attentions";

    protected $fillable = [
        'global',
        'receiver_id',

        'action',
        'attentionable_id',
        'attentionable_type',
    ];

    protected $hidden = [];





    public function scopeUnseen($query)
    {
        return $query->where('seen', '=', false);
    }




    public function attentionable()
    {
        return $this->morphTo();
    }

    public function receiver()
    {
        return $this->belongsTo('Martin\Users\User', 'receiver_id');
    }

    public function viewer()
    {
        return $this->belongsTo('Martin\Users\User', 'seen_by');
    }

}
