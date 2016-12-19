<?php namespace Martin\Core;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Martin\Core\Traits\RecordsActivity;
use Martin\Reports\Reporter;
use ReflectionClass;

class Address extends Model {

    use SoftDeletes;

    use RecordsActivity;

    protected $drawAttentionEvents = ['created', 'updated'];


    use Reporter;

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

    protected $type;

    protected function getAddressableType()
    {
        if ($this->type)
            return $this->type;

        return $this->type = strtolower((new ReflectionClass($this->addressable))->getShortName());
    }

    public function getUrlToAddressable()
    {
        $model = $this->addressable;
        $type = $this->getAddressableType();

        switch ($type) {
            case "payer":
            case "payment":
                $type .= "s";
                break;
            default:
                break;
        }
        return "/admins/{$type}/{$model->id}";
    }


    public function toString()
    {

        $output = $this->street_1 .", ";
        if ($this->street_2)
            $output .= $this->street_2 .", ";

        $output .= <<<EOT
$this->city , $this->province , $this->postal_code , $this->country 
EOT;

        return $output;

    }



    public function generateString()
    {
        $output = $this->street_1 .", ";
        if ($this->street_2)
            $output .= $this->street_2 .", ";

        $output .= $this->city  . ", " . $this->province
            . ", " . $this->postal_code  . ", " . $this->country;

        return $output;
    }

    public function trash()
    {
        return $this->delete();
    }

} 
