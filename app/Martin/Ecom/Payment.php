<?php namespace Martin\Ecom;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model {

	protected $table = "payments";


    public function setUniqueId()
    {
        $this->unique_id = session('unique_id');
    }

}
