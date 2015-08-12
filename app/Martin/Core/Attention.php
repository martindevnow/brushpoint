<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Attention extends Model {

	protected $table = "attentiones";

    protected $fillable = [
        'global',
        'receiver_id',

        'action',
        'attentionable_id',
        'attentionable_type',
    ];

    protected $hidden = [];



    public function attentionable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo('Martin\Users\User', 'receiver_id');
    }

}
