<?php namespace Martin\Products;

use Illuminate\Database\Eloquent\SoftDeletes;
use Martin\Core\CoreModel;
use Martin\Core\Traits\RecordsActivity;

class Virtue extends CoreModel {

    use SoftDeletes;
    use RecordsActivity;

    protected $table = 'virtues';

    protected $fillable = [
        'body',
        'type'
    ];


    public function product()
    {
        return $this->belongsTo('Martin\Products\Product');
    }
}
