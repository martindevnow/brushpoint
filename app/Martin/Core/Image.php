<?php namespace Martin\Core;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Martin\Core\Traits\RecordsActivity;
use ReflectionClass;

class Image extends Model {

    use SoftDeletes;

    use RecordsActivity;

    protected $table = 'images';

    protected $fillable = [
        'user_id',
        'content',
        'height',
        'width',
        'path',
        'thumbnail'
    ];

    protected $hidden = [];

    public function adminDownloadLink()
    {
        return "/admins/images/download/". $this->id;
    }

    public function imageable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo('Martin\Users\User');
    }

    public function trash() {
        return $this->delete();
    }

    protected function getImageableType()
    {
        if ($this->type)
            return $this->type;

        return $this->type = strtolower((new ReflectionClass($this->imageable))->getShortName());
    }

    public function getUrlToImageable()
    {
        $model = $this->imageable;
        $type = $this->getImageableType();

        switch ($type) {
            case "payment":
                $type .= "s";
                break;
            default:
                break;
        }
        return "/admins/{$type}/{$model->id}";
    }
} 