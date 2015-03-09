    <?php

    use Illuminate\Database\Seeder;

    use Faker\Factory as Faker;
    use Illuminate\Support\Facades\DB;
    use Martin\Users\User;

    class UsersTableSeeder extends Seeder {

        public function run()
        {
            DB::table('users')->delete();

            $faker = Faker::create();

            foreach(range(1,25) as $index)
            {
                User::create([
                    'name' => $faker->word . $index,
                    'email' => $faker->email,
                    'password' => 'secret'
                ]);
            }
        }
    }