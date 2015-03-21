<?php


namespace Martin\Products;


use Martin\Core\CoreModel;

class Feedback extends CoreModel {

    protected $table = 'feedbacks';

    protected $fillable = [
        'name', 'email', 'phone', 'address', 'retailer', 'lot_code', 'issue'
    ];

} 