<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Martin\Products\Inventory;
use Martin\Products\Item;
use Martin\Quality\Contact;
use Martin\Quality\Feedback;

class InventoriesTableSeeder extends Seeder {

    public function run()
    {

        DB::table('inventories')->truncate();

        /*
         * 15 - RH-DZ-SOFT
         * 16 - RH-DZ-MED
         * 17 - RH-DM-SOFT
         * 18 - RH-DM-MED
         * 19 - RH-OSC
         * 20 - RH-SONIC
         * 21 - ID-CARE
         * 22 - ID-FLOSS
         */


        // OLD STOCK
        $dt = new DateTime();
        $dt->setDate(2012,10,30);


        // Old Stock - OOS
        Inventory::create([
            'item_id' => 15,
            'lot_code' => '10/09-OLD_OOS',
            'expiry_date' => $dt->format('y-m-d H:i:s'),
            'quantity' => '0',
            'original_quantity' => '100',
            'description' => 'restock',
        ]);



        // Old Stock - Have, but shouldn't ship
        Inventory::create([
            'item_id' => 16,
            'lot_code' => '10/09_OLD_INSTOCK_NOSHIP',
            'expiry_date' => $dt->format('y-m-d H:i:s'),
            'quantity' => '20',
            'original_quantity' => '100',
            'description' => 'restock',
        ]);




        // NEW(ISH) STOCK
        $dt->setDate(2016,10,30);


        // New(ish) Stock - OOS - Should ship, but OOS
        Inventory::create([
            'item_id' => 17,
            'lot_code' => '10/13_NEWISH_OOS',
            'expiry_date' => $dt->format('y-m-d H:i:s'),
            'quantity' => '0',
            'original_quantity' => '100',
            'description' => 'restock',
        ]);




        // TOO NEW STOCK
        $dt->setDate(2020,10,30);


        // Stock too new (have older stuff), so shouldn't ship it
        Inventory::create([
            'item_id' => 18,
            'lot_code' => '10/15_TOO_NEW_STOCK',
            'expiry_date' => $dt->format('y-m-d H:i:s'),
            'quantity' => '0',
            'original_quantity' => '100',
            'description' => 'restock',
        ]);


        $items = Item::where('price', '>', '0')->get();
        $dt->setDate(2017,10,30);

        foreach ($items as $item)
        {
            if ($item->id > 14 && $item->id < 23)
            {
                Inventory::create([
                    'item_id' => $item->id,
                    'lot_code' => '10/14_THIS_STOCK_SHIPS',
                    'expiry_date' => $dt->format('y-m-d H:i:s'),
                    'quantity' => '100',
                    'original_quantity' => '100',
                    'description' => 'restock',
                ]);
            }
        }
    }
}