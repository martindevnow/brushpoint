<?php namespace Martin\Quality;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model {

	protected $fillable = [
        'ip',
        'name',
        'email',
        'message'
    ];




}
