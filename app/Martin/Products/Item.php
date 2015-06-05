<?php


namespace Martin\Products;


use Illuminate\Support\Facades\DB;
use Martin\Core\CoreModel;

class Item extends CoreModel {
    protected $table = 'items';

    protected $fillable = [
        'product_id',
        'name',
        'description',
        'sku',
        'price',
        'on_hand',
        'variance',
    ];

    public function getInventory()
    {
        $inventory = Inventory::where('item_id', '=', $this->id)
            ->active()
            ->orderBy('created_at', 'ASC')->first(); // oldest first
    }


    public function getActiveInventory()
    {
        $inventory = DB::table('inventories')
            ->select('item_id', DB::raw('sum(quantity) as total'))
            ->groupBy('item_id')
            ->where('item_id', '=', $this->id)
            ->where('description', '=', 'available')
            ->first();

        return $inventory;
    }


    public function getOldestActiveInventory()
    {
        return Inventory::where('item_id', '=', $this->id)
            ->where('description', '=', 'available')
            ->orderBy('created_at', 'ASC')
            ->first();
    }




    public function product()
    {
        return $this->belongsTo('Martin\Products\Product');
    }

    public function purchases()
    {
        return $this->hasMany('Martin\Sales\Purchase');
    }

    public function carts()
    {
        return $this->hasMany('Martin\Products\Cart');
    }

    public function soldItems()
    {
        return $this->hasMany('Martin\Ecom\SoldItem');
    }

    public function inventories()
    {
        return $this->hasMany('Martin\Products\Inventory');
    }
} 