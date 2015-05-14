<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;
use Martin\Core\Image;
use Martin\Products\Item;
use Martin\Products\Product;
use Martin\Products\Virtue;

class ProductsTableSeeder extends Seeder {

    public function run()
    {
        /**
         * Clear the Databases
         */
        DB::table('products')->truncate();
        DB::table('items')->truncate();
        DB::table('images')->truncate();
        DB::table('virtues')->truncate();

        $faker = Faker::create();

        /**
         * VITAL HEALTH SERIES
         *
         * display_order = 1X
         *
         */

        $products = array();
        $products[] =
            [
                "sku" => "VitalHealthBattery",
                "video_link" => "http://www.youtube.com/embed/LKrBUy8kui4",
                "video_name" => "Play to See Dual Motion Head Action",
                "name" => "Vital Health&reg; Power Oral Care System - Battery",
                "benefits" => ["10 Vital Oral Health Benefits",
                    "Complete Oral Care Solution in one kit – Brush – Floss – Care",
                    "Ideal for Braces, bridges and crowns",
                    "Outstanding Value!"],

                "features" => ["Advanced Dual Motion Cleaning Action!",
                    "Top Oscillating Brush head surrounds each tooth to thoroughly clean and polish teeth",
                    "Bottom bristles move back and forth to help break up plaque and clean between teeth",
                    "2 Dual Motion Replacement heads (Fully tufted with Dupont Tynex bristles) included",
                    "Easy to use on & off buttons",
                    "Premium rubber comfort grips",
                    "2 ‘AA’ Alkaline Batteries included"],

                "claim" => "<strong>Available in most Walmart Stores in the United States for $7.50.</strong>",
                "other" => "Power Arm Kit Includes:",
                "other_list" => ["2 Sulcus Tip attachments help clean between teeth and along the gum line",
                    "1 Gum Stimulator helps firm and strengthen gums",
                    "20 Floss Heads help clean between teeth"],

                "link_to_video" => 1,
                "active" => 1,
                "display_order" => "11"  // SHOW FIRST
            ];

        $products[] =
            [
                "sku" => "VitalHealthRechargeable",
                "map" => 1,
                "map_info" => serialize([
                    array("shape" => "rect", "coords" => "39,335,299,359", "href" => "/video/IMG_1094.MOV"),
                    array("shape" => "rect", "coords" => "39,306,281,331", "href" => "/pdfs/IFandCA_Usage_Instructions.pdf", "target" => "_blank"),
                ]),
                "name" => "Vital  Health&reg; Power Oral Care System - Rechargeable",
                "benefits" => ["10 Vital Oral Health Benefits",
                    "Sustained Rechargeable Cleaning Power",
                    "Complete Oral Care Solution in one kit – Brush – Floss – Care",
                    "Ideal for Braces, bridges and crowns",
                    "Outstanding Value!"],

                "features" => ["1 Rechargeable Power Toothbrush and a Compact Charger Stand",
                    "Two Minute Timer",
                    "Dual Motion Deep Cleaning Power",
                    "High Motion Oscillating Heads helps polish teeth and clean along the gum line",
                    "Interdental Power Arm Kit",
                    "Easy to use on & off buttons",
                    "Slim Design "],

                "other" => "Power Arm Kit Includes:",
                "other_list" => ["2 Sulcus Tip attachments help clean between teeth and along the gum line",
                    "1 Gum Stimulator helps firm and strengthen gums",
                    "20 Floss Heads help clean between teeth"],
                "active" => 1,
                "display_order" => "12" // SHOW
            ];

        $products[] =
            [
                "sku" => "VitalHealthSonicPower",
                "name" => "Vital Health&reg; Sonic Power Oral Care System &ndash; Battery",
                "benefits" => ["10 Vital Oral Health Benefits",
                    "Complete Sonic Oral Care Solution in one kit &ndash; Brush &ndash; Floss &ndash; Care",
                    "Ideal for Braces, bridges and crowns",
                    "Outstanding Value!"],

                "features" => ["Unique Battery powered Sonic toothbrush",
                    "Over 22,000 active sonic vibrations per minute",
                    "Multi-level bristles for deep cleaning",
                    "1 AA battery included"],

                "other" => "Power Arm Kit Includes:",
                "other_list" => ["2 Sulcus Tip attachments help clean between teeth and along the gum line",
                    "1 Gum Stimulator helps firm and strengthen gums",
                    "20 Floss Heads help clean between teeth"],
                "active" => 1,
                "display_order" => "13" // SHOW THIRD
            ];


        /**
         * CHILDRENS TOOTHBRUSHES SERIES
         *
         * display_order = 3X
         */


        $products[] =
            [
                "sku" => "ChildrensPower",
                "name" => "Children&#8217;s Power Toothbrush",
                "benefits" => ["Children will have fun brushing longer",
                    "Gently Cleans Teeth "],
                "features" => ["Small Oscillating Head gently cleans teeth",
                    "Fully tufted Extra Soft Dupont Tynex bristles",
                    "Easy Hold Design is comfortable for small hands",
                    "Long brush head to clean hard to reach places",
                    "Easy to use on/off button",
                    "Stands upright or sits flat so brush head stays off the counter",
                    "2 replaceable ‘AAA’ Alkaline Batteries included"],
                "spacer_height" => "125",
                "active" => 1,
                "display_order" => "33"
            ];
        $products[] =
            [
                "sku" => "ChildrensManual",
                "name" => "Children&#8217;s Manual Toothbrush",
                "benefits" => ["Gently Cleans Teeth and Tongue",
                    "Easy Hold Design"],
                "features" => ["Small Head gently cleans teeth and massages gums",
                    "Fully tufted Extra Soft Dupont Tynex bristles",
                    "Slim handle and rubber grips are ideal for small hands",
                    "Tongue Cleaner gently cleans tongue and cheeks",
                    "Ideal for Children 4 to 8 years old"],
                "spacer_height" => "175",
                "active" => 1,
                "display_order" => "32"
            ];



        $products[] =
            [
                "sku" => "ChildrensSonicPower",
                "name" => "Children&#8217;s Sonic Power Toothbrush",
                "benefits" => ["<strong>Gentle sonic wave vibrations
                        provide a deep clean for smaller mouths</strong>"],

                "features" => ["Unique Battery powered Children`s Sonic toothbrush",
                    "Over 18,000 active sonic vibrations per minute",
                    "Multi-level bristles for deep cleaning",
                    "Slim Easy to Hold handle design",
                    "Extra Soft Bristles",
                    "Patent Pending Technology",
                    "1 AA battery included"],
                "active" => 1,
                "display_order" => "31"
            ];


        /**
         * OTHER BRUSHES SERIES
         *
         * display_order = 8X
         */
        $products[] =
            [
                "sku" => "SonicPower",
                "name" => "Sonic Power Toothbrush",
                "benefits" => ["Active sonic wave vibrations  provide a deep clean"],
                "features" => ["Unique Battery powered Sonic toothbrush",
                    "Over 22,000 active sonic vibrations per minute",
                    "Multi-level bristles for deep cleaning",
                    "Slim handle design",
                    "Metallic handle colors",
                    "Patent Pending Technology",
                    "1 AA battery included"],
                "active" => 1,
                "display_order" => "41"
            ];
        $products[] =
            [
                "sku" => "DualZoneHighRotation",
                "name" => "Dual Zone High Rotation Toothbrush",
                "benefits" => ["Superior High Rotation Head Helps Break up plaque and bottom zone bristles clean between teeth",
                    "Fantastic Value!"],

                "features" => ["Up to 60% more rotation than the leading brands",
                    "<strong>Patented</strong> rotational Brush head technology",
                    "Fully tufted with Dupont Tynex bristles",
                    "Long replaceable brush head to clean hard to reach places",
                    "Easy to use on & off buttons",
                    "Premium rubber comfort grips",
                    "2 ‘AA’ Alkaline Batteries included",
                    "2 pack replacement heads available"],

                "claim" => "",
                "patent_link" => "file_group006536066-001.pdf",
                "patent_name" => "U.S. Patent 6,536,066 B2 - March 2003",
                "video_name" => "",
                "video_link" => "",
                "active" => 1,
                "display_order" => "56"
            ];

        $products[] =
            [
                "sku" => "PowerWhitening",
                "name" => "Power Whitening Toothbrush",
                "benefits" => ["<strong>Patented</strong> whitening technology to remove stains and clean teeth for a naturally whiter smile!",
                    "Clinically Proven Whitening technology†!"],

                "features" => ["Full motion pulsating brush head",
                    "End rounded, fully tufted Dupont Tynex Bristles",
                    "Elastomeric Gum Stimulators",
                    "Rubber Bottom blade helps whisk away stains",
                    "Angled and replaceable brush head",
                    "Single Rubber on/off button",
                    "Metallic designer colors",
                    "Ergonomic Slim design with finger grips",
                    "2 ‘AA’ Alkaline Batteries included",
                    "2 Pack replacement heads available"],

                "claim" => "†this pulsating bristle technology has been clinically proven to provide superior stain removal versus a manual toothbrush",
                "video_name" => "Power Whitening Brush Head Action – BrushPoint",
                "video_link" => "http://www.youtube.com/embed/_5Ym_D1-e34?rel=0",
                "patent_link" => "us0re035941-group.pdf",
                "patent_name" => "U.S. Patent No. Re. 35,941",
                "active" => 1,
                "display_order" => "55"
            ];

        $products[] =
            [
                "sku" => "ProfessionalCleanPower",
                "name" => "Professional Clean Power Toothbrush",
                "benefits" => ["Helps remove Plaque for a Professional Clean feel"],

                "features" => ["Innovative Dual Motion brush head to actively sweep away plaque",
                    "Top Oscillating Brush head surrounds each tooth to thoroughly clean and polish teeth",
                    "Bottom bristles move back and forth to help break up plaque and clean between teeth",
                    "End rounded, fully tufted Dupont Tynex Bristles",
                    "Angled and replaceable brush head",
                    "Single Rubber on/off button",
                    "Metallic Silver with designer colored on/off button",
                    "Ergonomic Slim design with finger grips",
                    "2 ‘AA’ Alkaline Batteries included",
                    "2 Pack replacement heads available"],

                "patent_link" => "",
                "patent_name" => "",
                "video_link" => "http://www.youtube.com/embed/iBiKqVDwKtI",
                "video_name" => "Play to See Dual Motion Head Action",
                "active" => 1,
                "display_order" => "54"
            ];

        $products[] =
            [
                "sku" => "Pulsating",
                "name" => "Pulsating Toothbrush",
                "benefits" => ["Pulsating bristles provide deep cleaning power!",
                    "Slim manual design in a power brush"],

                "features" => ["Gentle Pulsating Bristles penetrate deep between teeth",
                    "Vibrating Flex Head helps break up plaque",
                    "Fully tufted Dupont Tynex Bristles",
                    "Flexible Side Bristles pivot to get deep between teeth",
                    "Cleans and gently stimulates gums ",
                    "Slim ergonomic rubber comfort grip handle",
                    "Easy to use on and off buttons",
                    "1 replaceable AAA alkaline battery included"],
                "active" => 1,
                "display_order" => "53"
            ];

        $products[] =
            [
                "sku" => "OscillatingCleanRechargeable",
                "name" => "Oscillating Clean Rechargeable Toothbrush",
                "benefits" => ["Deep thorough cleaning that surrounds each tooth",
                    "Sustained rechargeable cleaning power"],
                "features" => ["High motion single oscillating head",
                    "Oscillating cleaning action designed to break up plaque and clean between the teeth",
                    "Designed to easily get to hard-to-reach areas",
                    "Angled replaceable brush head",
                    "Single Rubber on/off button",
                    "Metallic designer colors",
                    "Compact Charger Stand",
                    "Ideal for travel as it lasts 5 days between charges",
                    "3 Pack replacement heads available"],
                "active" => 1,
                "display_order" => "52"
            ];

        $products[] =
            [
                "sku" => "PulsatingCleanRechargeable",
                "name" => "Pulsating Clean Rechargeable Toothbrush",
                "benefits" => ["Advanced pulsating cleaning technology that is clinically proven† to effectively remove plaque and reduce gingivitis",
                    "Sustained rechargeable cleaning power"],
                "features" => ["<strong>Patented</strong> Pulsating Full Motion Head Technology",
                    "Active pulsations provide deep cleaning to help remove plaque, reduce gingivitis and superior stain removal",
                    "Gets at hard-to-reach areas",
                    "Angled and replaceable brush head",
                    "Single Rubber on/off button",
                    "Metallic designer colors",
                    "Compact Charger Stand",
                    "Ideal for travel as it lasts 5 days between charges",
                    "3 Pack replacement heads available"],
                "claim" => "†this pulsating bristle technology has been clinically proven to provide superior plaque removal, reduce gingivitis and remove stains better versus a manual toothbrush",
                "patent_link" => "us0re035941-group.pdf",
                "patent_name" => "U.S. Patent No. Re. 35,941",
                "active" => 1,
                "display_order" => "51"
            ];


        $products[] =
            [
                "sku" => "ManualToothbrushes",
                "name" => "Manual Toothbrushes & Accessories",
                "other" => "<strong>BrushPoint offers the following premium German Engineered Manual Toothbrushes in the United States and Canada:</strong><br />
            <p>
            Manual models include Deep Clean, Sensitive, Whitening and  Vital Health&reg; benefits.<br /><br />
            Other Dental Brushes and accessories are also available and include a Travel Brush, Interdental Picks, Manual Interdental Oral Care System, Manual Denture Brush, Flossers, Dental Floss and Premium No Shred Dental Tape.
            </p>",
                "active" => 1,
                "display_order" => "21"
            ];

        $products[] =
            [
                "sku" => "WhiteningDentalStrips",
                "name" => "Whitening Dental Strips",
                "heading" => "<strong>BrushPoint offers premium Whitening Dental Strips for the North American market.  Several formats are available including Advanced, Professional and 2 Hour systems.</strong>",
                "benefits" => ["Get a visibly Whiter Smile!",
                    "See results in as little as 3 days!"],

                "features" => ["Stay-on, Non-slip Technology",
                    "Easy Application",
                    "Dramatically Whitens Teeth and removes stains",
                    "Uses the same Whitening agents as your Dentist",
                    "Enamel Safe",
                    "3 Layer System",
                    "Patent Pending Technology"],
                "claim" => "Available in daily 30 minute and 2 Hour Whitening Release Systems.",
                "active" => 0,
                "display_order" => "999"
            ];

        $products[] =
            [
                "sku" => "WhiteningPen",
                "name" => "Whitening Pen",
                "heading" => "<strong>Whitening Pen Heading Here</strong>",
                "benefits" => ["Get a visibly Whiter Smile!",
                    "See results in as little as 3 days!"],

                "features" => ["Stay-on, Non-slip Technology",
                    "Easy Application",
                    "Dramatically Whitens Teeth and removes stains",
                    "Uses the same Whitening agents as your Dentist",
                    "Enamel Safe",
                    "3 Layer System",
                    "Patent Pending Technology"],
                "claim" => "Available in daily 30 minute and 2 Hour Whitening Release Systems.",
                "active" => 1,
                "display_order" => "22"
            ];



        foreach ($products as $prod)
        {
            $prod['portfolio'] = 1;
            $prod['purchase'] = 0;

            if (isset($prod['features']))
            {
                $virtues['feature'] = $prod['features'];
                unset($prod['features']);
            }

            if (isset($prod['benefits']))
            {
                $virtues['benefit'] = $prod['benefits'];
                unset($prod['benefits']);
            }


            if (isset($prod['other_list']))
            {
                $virtues['other'] = $prod['other_list'];
                unset($prod['other_list']);
            }


            $dbProd = Product::create($prod);


            foreach($virtues as $type => $virtue)
            {
                if (is_array($virtue))
                {
                    foreach ($virtue as $virt)
                    {
                        $dbVirtue = Virtue::create([
                            'type' => $type,
                            'body' => $virt
                        ]);
                        $dbProd->virtues()->save($dbVirtue);
                    }
                }
                else
                {
                    $dbVirtue = Virtue::create([
                        'type' => $type,
                        'body' => $virtue
                    ]);
                    $dbProd->virtues()->save($dbVirtue);
                }
            }


            $image1 = Image::create([
                'height' => 150,
                'width' => 240,
                'path' => '/images/brushpoint/products/'. $prod['sku'] . '-150.png',
                'thumbnail' => true
            ]);
            $image2 = Image::create([
                'height' => 300,
                'width' => 555,
                'path' => '/images/brushpoint/products/'. $prod['sku'] . '-555.png',
                'thumbnail' => true
            ]);
            $dbProd->images()->save($image1);
            $dbProd->images()->save($image2);
        }
    }
}