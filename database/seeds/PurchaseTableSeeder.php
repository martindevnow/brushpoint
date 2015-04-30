<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;
use Martin\Core\Image;
use Martin\Products\Item;
use Martin\Products\Product;

class PurchaseTableSeeder extends Seeder {

    public function run()
    {

        $faker = Faker::create();

        $replacementHeads = [
            [
                'name' => 'Dual Zone Replacement Heads - (4 Pack)',
                'description' => 'Oscillating power for the top zone and stationary bristles on the lower zone provides excellent cleaning power',
                'sku' => 'RH-DZ',
                'price' => 5.00,
                'unit_weight_g' => 48,
                'unit_depth_cm' => 1.5,
            ],
            [
                'name' => 'Dual Motion Replacement Heads - (4 Pack)',
                'description' => 'Oscillating power for the top zone and rocking bristles on the lower zone provides the ultimate in cleaning power',
                'sku' => 'RH-DM',
                'price' => 5.50,
                'unit_weight_g' => 50,
                'unit_depth_cm' => 1.5,
            ],
            [
                'name' => 'Single Oscillating Replacement Head - (4 Pack)',
                'description' => 'Targeted Oscillating power for ultimate maneuverability and targeted cleaning.',
                'sku' => 'RH-OSC',
                'price' => 5.00,
                'unit_weight_g' => 40,
                'unit_depth_cm' => 1.5,
            ],
            [
                'name' => 'Sonic Replacement Head - (4 Pack)',
                'description' => 'Sonic vibrations break up plaque and destroy cavity causing bacteria. (Only fits the sonic toothbrush)',
                'sku' => 'RH-SONIC',
                'price' => 6.00,
                'unit_weight_g' => 33,
                'unit_depth_cm' => 2.2,
            ],
            [
                'name' => 'InterDental Care Kit - (9 Pack)',
                'description' => 'Replacements for the various attachments for the Inter Dental Care Kit. (6 Sulcus Tips and 3 Gum Stimulators)',
                'sku' => 'ID-CARE',
                'price' => 3.00,
                'unit_weight_g' => 12,
                'unit_depth_cm' => 1.5,
            ],
            [
                'name' => 'InterDental Floss Heads - (60 Pack)',
                'description' => 'Clean those hard to reach spots with the InterDental Floss Heads available in sets of 60/pack.',
                'sku' => 'ID-FLOSS',
                'price' => 6.00,
                'unit_weight_g' => 115,
                'unit_depth_cm' => 2.5,
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
                'on_hand' => $faker->numberBetween(100,500),
                'active' => 1,
                'portfolio' => 0,
                'purchase' => 1,
                'unit_weight_g' => $rh['unit_weight_g'],
                'unit_depth_cm' => $rh['unit_depth_cm'],
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
                $sku = str_replace('**', '', $prod->sku);
                Item::create([
                    'product_id' => $prod->id,
                    'name' => $prod->name . " [Soft]",
                    'description' => $prod->description,
                    'sku' => $sku . "SOFT",
                    'price' => $prod->price,
                    'on_hand' => $prod->on_hand,
                    'variance' => 'Soft',
                ]);
                Item::create([
                    'product_id' => $prod->id,
                    'name' => $prod->name . " [Medium]",
                    'description' => $prod->description,
                    'sku' => $sku . "MED",
                    'price' => $prod->price,
                    'on_hand' => $prod->on_hand,
                    'variance' => 'Medium',
                ]);
            }
            else{
                $sku = str_replace('**', '', $prod->sku);
                Item::create([
                    'product_id' => $prod->id,
                    'name' => $prod->name,
                    'description' => $prod->description,
                    'sku' => $sku,
                    'price' => $prod->price,
                    'on_hand' => $prod->on_hand,
                ]);
            }
        }
    }
}