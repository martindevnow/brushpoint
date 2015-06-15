<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Martin\Quality\Issue;

class IssuesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('issues')->truncate();

        /*$filename = base_path() . '\database\seeds\file\Issues.csv';

        $query = <<<eof
            LOAD DATA INFILE '$filename'
             INTO TABLE issues
             FIELDS TERMINATED BY '|' OPTIONALLY ENCLOSED BY '"'
             LINES TERMINATED BY '\n'
            (name)
eof;

        DB::statement($query);*/

        //get the csv file
        $file = base_path() . '\database\seeds\file\Issues.csv';
        $handle = fopen($file,"r");

        //loop through the csv file and insert into database


        while ($data = fgetcsv($handle,1000,",","'"))
        {
            if ($data[0]) {
                Issue::create(['type' => $data[0], 'complaint' => $data[1]]);
            }
        }

    }
}