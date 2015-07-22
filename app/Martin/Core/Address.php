<?php namespace Martin\Core;

use Illuminate\Database\Eloquent\Model;
use Martin\Core\Traits\RecordsActivity;

class Address extends Model {

    use RecordsActivity;

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

    public function payments()
    {
        return $this->hasMany('Martin\Ecom\Payment');
    }

    public function toString()
    {

        $output = $this->street_1 ."<br />";
        if ($this->street_2)
            $output .= $this->street_2 ."<br />";

        $output .= <<<EOT
$this->city <br />
$this->province <br />
$this->postal_code <br />
$this->country <br />

EOT;

        return $output;

    }

} 