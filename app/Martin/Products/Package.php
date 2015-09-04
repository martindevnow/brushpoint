<?php namespace Martin\Products;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Martin\Core\CoreModel;
use Martin\Core\Traits\RecordsActivity;

class Package extends CoreModel {

    use RecordsActivity;
    use SoftDeletes;

	//

}
