<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Martin\Quality\Retailer;

class RetailersTableSeeder extends Seeder {

    public function run()
    {
        DB::table('retailers')->truncate();


        /*
        $filename = base_path() . '\database\seeds\file\Retailers.csv';
        // dd($filename);

        $query = <<<eof
            LOAD DATA INFILE '$filename'
             INTO TABLE retailers
             FIELDS TERMINATED BY '|' OPTIONALLY ENCLOSED BY '"'
             LINES TERMINATED BY '\n'
            (type)
eof;
        DB::statement($query);*/

        //get the csv file
        $file = base_path() . '\database\seeds\file\Retailers.csv';
        $handle = fopen($file,"r");

        //loop through the csv file and insert into database


        while ($data = fgetcsv($handle,1000,",","'"))
        {
            if ($data[0]) {
                Retailer::create(['name' => $data[0], 'active' => '1']);
            }
        }
    }
}