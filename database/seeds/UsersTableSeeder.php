    <?php

    use Illuminate\Database\Seeder;

    use Faker\Factory as Faker;
    use Illuminate\Support\Facades\DB;
    use Martin\Users\User;

    class UsersTableSeeder extends Seeder {

        public function run()
        {
            DB::table('users')->truncate();

            $faker = Faker::create();

            User::create([
                'name' => 'Ben',
                'email' => 'ben@me.com',
                'password' => bcrypt('123456')
            ]);

            foreach(range(1,3) as $index)
            {
                User::create([
                    'name' => $faker->word . $index,
                    'email' => $faker->email,
                    'password' => bcrypt('secret')
                ]);
            }
        }
    }