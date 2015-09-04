<?php namespace Martin\Core;

use Illuminate\Database\Eloquent\Model;

class Trash extends Model {

	protected $table = 'trash';

    protected $fillable = [
        'user_id',
        'reason',
        'trashable_type',
        'trashable_id',
    ];

    protected $hidden = [];



    public function authorize()
    {
        $this->trashable->delete();
    }

    public function trashable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo('Martin\Users\User');
    }

}
