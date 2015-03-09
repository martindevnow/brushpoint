<?php namespace Martin\Core;

use Illuminate\Database\Eloquent\Model;

class Address extends Model {

    protected $table = 'addresses';

    protected $fillable = [
        'description',
        'name',
        'company',

        'street_1', 	// string
        'street_2', 	// string
        'city', 	    // string
        'province',     // string
        'postal_code',  // string
        'country',      // string

        'phone', 	    // string
        'buzzer',

        // shipping address only
        'ppid', 		// string
        'recipient_name', // string
        'default_address', // bool
    ];

    protected $hidden = [];

    public function addressable()
    {
        return $this->morphTo();
    }

} 