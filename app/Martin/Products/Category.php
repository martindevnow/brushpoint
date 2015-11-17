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
        return (new static)->where('slug', '=', $slug)->firstOrFail();
    }


    public function activeProducts()
    {
        return $this->products()
            // ->where('active', '=', 1)
            ->orderBy('display_order', 'asc')
            ->get();
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withTimestamps();
    }

}
