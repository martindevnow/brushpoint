<?php namespace Martin\Products;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

	protected $table = "categories";

    protected $fillable = [
        'name',
        'description',
        'slug',
    ];


    public static function bySlug($slug)
    {
        return (new static)->where('slug', '=', $slug)->first();
    }


    public function activeProducts()
    {
        return $this->products()
            //->where('active', '=', 1)
            ->get();
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withTimestamps();
    }

}
