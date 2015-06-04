    <?php

    use Illuminate\Database\Seeder;

    use Faker\Factory as Faker;
    use Illuminate\Support\Facades\DB;
    use Martin\Users\User;

    class UsersTableSeeder extends Seeder {

        public function run()
        {
            DB::table('users')->truncate();

            User::create([
                'name' => 'Ben Martin',
                'email' => 'ben@me.com',
                'password' => bcrypt('123456'),
            ]);


            User::create([
                'name' => 'Paul',
                'email' => 'paulc@brushpoint.com',
                'password' => bcrypt('123456'),
            ]);


            User::create([
                'name' => 'Vivian Wong',
                'email' => 'vivianw@brushpoint.com',
                'password' => bcrypt('123456'),
            ]);
        }
    }