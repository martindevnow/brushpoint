<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;
use Martin\Core\Image;
use Martin\Products\Inventory;
use Martin\Products\Item;
use Martin\Products\Product;

class PurchaseTableSeeder extends Seeder {

    public function run()
    {

        $faker = Faker::create();

        $replacementHeads = [
            [
                'name' => 'Dual Zone Replacement Heads',
                'description' => 'High oscillating power brush head combined with lower stationary bristles to provide a deep thorough clean.',
                'sku' => 'RH-DZ',
                'price' => 5.00,
                'unit_weight_g' => 48,
                'unit_depth_cm' => 1.5,
                'pack_size' => 4,
                'pack_description' => '4 Pack',
                'display_order' => 3,
            ],
            [
                'name' => 'Dual Motion Replacement Heads',
                'description' => 'Dual motion brush head to actively sweep away plaque and clean teeth. Top oscillates while bottom bristles move back and forth.',
                'sku' => 'RH-DM',
                'price' => 5.50,
                'unit_weight_g' => 50,
                'unit_depth_cm' => 1.5,
                'pack_size' => 4,
                'pack_description' => '4 Pack',
                'display_order' => 1,

            ],
            [
                'name' => 'Single Oscillating Replacement Head',
                'description' => 'Compact oscillating brush head that surrounds each tooth for a deep clean.',
                'sku' => 'RH-OSC',
                'price' => 5.00,
                'unit_weight_g' => 40,
                'unit_depth_cm' => 1.5,
                'pack_size' => 4,
                'pack_description' => '4 Pack',
                'display_order' => 2,

            ],
            [
                'name' => 'Sonic Replacement Head',
                'description' => 'Active Sonic vibrations helps sweep away plaque. Multi-level bristling. (Only fits the Sonic toothbrush)',
                'sku' => 'RH-SONIC',
                'price' => 6.00,
                'unit_weight_g' => 33,
                'unit_depth_cm' => 2.2,
                'pack_size' => 4,
                'pack_description' => '4 Pack',
                'display_order' => 4,

            ],
            [
                'name' => 'InterDental Care Kit',
                'description' => '6 Sulcus tips and 3 gum stimulators. Compatible with our Vital Health battery and rechargeable Oral Care Systems. ',
                'sku' => 'ID-CARE',
                'price' => 3.00,
                'unit_weight_g' => 12,
                'unit_depth_cm' => 1.5,
                'pack_size' => 9,
                'pack_description' => '6 Sulcus Tips and 3 Gum Stimulators',
                'display_order' => 5,

            ],
            [
                'name' => 'InterDental Floss Heads',
                'description' => '60 floss heads. Compatible with our Vital Health battery and rechargeable Oral Care Systems.',
                'sku' => 'ID-FLOSS',
                'price' => 6.00,
                'unit_weight_g' => 115,
                'unit_depth_cm' => 2.5,
                'pack_size' => 60,
                'pack_description' => '60 Pack',
                'display_order' => 6,

            ]
        ];


        /**
         * Add the Replacement Heads as Products
         */
        foreach($replacementHeads as $rh)
        {
            $product = Product::create([
                'name' => $rh['name'],
                'description' => $rh['description'],
                'sku' => $rh['sku'],
                'price' =>  $rh['price'],
                'on_hand' => 250,
                'active' => 1,
                'portfolio' => 0,
                'purchase' => 1,
                'unit_weight_g' => $rh['unit_weight_g'],
                'unit_depth_cm' => $rh['unit_depth_cm'],
                'pack_size' => $rh['pack_size'],
                'pack_description' => $rh['pack_description'],
            ]);

            $image1 = Image::create([
                'height' => 115,
                'width' => 115,
                'path' => '/images/brushpoint/purchase/'. $rh['sku'] . '-115.png',
                'thumbnail' => true
            ]);

            $image2 = Image::create([
                'height' => 150,
                'width' => 240,
                'path' => '/images/brushpoint/purchase/'. $rh['sku'] . '-240.png',
                'thumbnail' => true
            ]);

            $image3 = Image::create([
                'height' => 300,
                'width' => 555,
                'path' => '/images/brushpoint/purchase/'. $rh['sku'] . '-555.png',
                'thumbnail' => false
            ]);
            $product->images()->save($image1);
            $product->images()->save($image2);
            $product->images()->save($image3);
        }


        /**
         * Seed the items for the replacement heads
         */
        $products = Product::where('active', '=', 1)->get();
        foreach($products as $prod)
        {
            if ($prod->purchase && ($prod->sku == "RH-DM" || $prod->sku == "RH-DZ"))
            {
                $item1 = Item::create([
                    'product_id' => $prod->id,
                    'name' => $prod->name,
                    'description' => $prod->description,
                    'sku' => $prod->sku . "-SOFT",
                    'price' => $prod->price,
                    'on_hand' => $prod->on_hand / 2,
                    'variance' => 'Soft',
                ]);
                $item2 = Item::create([
                    'product_id' => $prod->id,
                    'name' => $prod->name,
                    'description' => $prod->description,
                    'sku' => $prod->sku . "-MED",
                    'price' => $prod->price,
                    'on_hand' => $prod->on_hand / 2,
                    'variance' => 'Medium',
                ]);
            }
            else{
                $item = Item::create([
                    'product_id' => $prod->id,
                    'name' => $prod->name,
                    'description' => $prod->description,
                    'sku' => $prod->sku,
                    'price' => $prod->price,
                    'on_hand' => $prod->on_hand,
                ]);
            }
        }
    }
}