<?php

namespace Martin\Quality;

use Martin\Core\CoreModel;
use Martin\Core\Traits\RecordsActivity;

class Retailer extends CoreModel{

    use RecordsActivity;

    protected $table = 'retailers';

    protected $fillable = [
        'name',
        'description',
        'active'
    ];


    public function feedbacks()
    {
        return $this->hasMany('Martin\Quality\Feedback');
    }
} 