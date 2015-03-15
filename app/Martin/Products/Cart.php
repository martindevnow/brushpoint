<?php

namespace Martin\Products;


use Martin\Core\CoreModel;

class Cart extends CoreModel {

    protected $table = 'carts';

    public function getCartExtendedPrice()
    {
        return $this->price * $this->quantity;
    }


    /**
     * Relation to the User model/DB
     *
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo('Martin\Users\User');
    }

    /**
     * Relation to the Item model/DB
     *
     * @return mixed
     */
    public function item()
    {
        return $this->belongsTo('Martin\Products\Item');
    }

} 