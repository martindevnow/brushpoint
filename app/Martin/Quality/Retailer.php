<?php


namespace Martin\Quality;


use Martin\Core\CoreModel;

class Retailer extends CoreModel{


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