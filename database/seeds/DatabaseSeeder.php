<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call('Users_Seeder');
		$this->call('Abz_Ranks_Seeder');      //fill DB table {abz_ranks}  with data.
        $this->call('Abz_Employees_Seeder');  //fill DB table {abz_employees} with data.
		$this->command->info('Seedering action was successful!');
		
    }
}


//fill DB table {users} with data 
class Users_Seeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();  //whether to Delete old materials

        //User::create(['email' => 'foo@bar.com']);
        DB::table('users')->insert(['id' => 1, 'name' => 'Admin', 'email' => 'test@gmail.com',     'password' => bcrypt('testtest') ]);
	    DB::table('users')->insert(['id' => 2, 'name' => 'Dima',  'email' => 'dimmm931@gmail.com', 'password' => bcrypt('dimadima') ]);
    }
}



//------------------- ALL SEEDERS CLASS -----------------------------------

//fill DB table {abz_ranks} with data 
class Abz_Ranks_Seeder extends Seeder {

    public function run()
    {
        DB::table('abz_ranks')->delete();  //whether to Delete old materials

        //User::create(['email' => 'foo@bar.com']);
        DB::table('abz_ranks')->insert(['id' => 1, 'rank_name' => "Rank1", 'rank_descr' => 'Rank 1 ops', ]);
	    DB::table('abz_ranks')->insert(['id' => 2, 'rank_name' => "Rank2", 'rank_descr' => 'Rank 2 ops', ]);
        DB::table('abz_ranks')->insert(['id' => 3, 'rank_name' => "Rank3", 'rank_descr' => 'Rank 3 ops', ]);
	    DB::table('abz_ranks')->insert(['id' => 4, 'rank_name' => "Rank4", 'rank_descr' => 'Rank 4 ops', ]);
        DB::table('abz_ranks')->insert(['id' => 5, 'rank_name' => "Rank5", 'rank_descr' => 'Rank 5 ops. Highest', ]);
  }
}



//fill DB table {abz_employees} with data 
class Abz_Employees_Seeder extends Seeder {

    public function run()
    {
        //DB::table('abz_employees')->delete();  //whether to Delete old materials
        //set auto increment back to 1 before seeding a table.
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('abz_employees')->truncate();
		
        $NUMBER_OF_EMPLOYEES = 60;		
        $faker = Faker::create();
        $gender = $faker->randomElement(['male', 'female']);

    	foreach (range(1, $NUMBER_OF_EMPLOYEES) as $index) {
            DB::table('abz_employees')->insert([
                'name'        => $faker->name($gender),
                'email'       => $faker->email,
                'username'    => $faker->username,
                'phone'       => $faker->phoneNumber,
                'dob'         => $faker->date($format = 'Y-m-d', $max = 'now'),
				'image'       => $faker->image(public_path('images/employees'),400,300, null, false), //saving images to 'public/images/students
				'rank_id'     => rand(1, 5), //random string between min and max number
                'superior_id' => rand(1, $NUMBER_OF_EMPLOYEES), //random string between min and max number
                'hired_at'    => $faker->dateTimeThisMonth(),
				'salary'      => rand(2000, 5000), //random string between min and max number
				//'text'      => $faker->realText($maxNbChars = 200, $indexSize = 2), //real text
			]);
        }
    }
}