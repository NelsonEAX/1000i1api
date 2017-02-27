<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
    	DB::table('users')->insert([
			'login' => 'NelsonEAX',
			'name' => 'Николай',
			'surname' => 'Николаев',
			'patronymic' => 'Викторович',
			'birthday' => date('1989-08-18'),
			'phone' => '9826892066',
			'email' => 'nelsoneax@yandex.ru',
			'password' => bcrypt('abc123d4'),
			'comment' => 'comment',			
			'is_eax' => true,
			'is_admin' => true,
			'is_private' => true,
			'is_legal' => true,
			'is_manager' => true,
			'is_manager_production' => true,
			'is_cutter' => true,
			'is_shareholder' => true,
			'is_storekeeper' => true,
			'is_dealer' => true,
			'is_franchise' => true,
			'is_agent' => true,
			'is_related' => true,
			'is_measurer' => true,
			'is_installer' => true,
			'is_delivery_city' => true,
			'is_delivery_region' => true,
			'is_confirmed' => true,
			'remember_token' => true,
			'created_at' => \Carbon\Carbon::now(),
			'updated_at' => \Carbon\Carbon::now()
		]);
		DB::table('users')->insert([
			'login' => 'managa',
			'name' => 'Владимир',
			'surname' => 'Яковлев',
			'patronymic' => 'Олегович',
			'birthday' => date('1988-02-29'),
			'phone' => '9530066436',
			'email' => 'sistem_p@mail.ru',
			'password' => bcrypt('1234abcd'),
			'comment' => 'comment',
			'is_eax' => false,
			'is_admin' => true,
			'is_private' => true,
			'is_legal' => true,
			'is_manager' => true,
			'is_manager_production' => true,
			'is_cutter' => true,
			'is_shareholder' => true,
			'is_storekeeper' => true,
			'is_dealer' => true,
			'is_franchise' => true,
			'is_agent' => true,
			'is_related' => true,
			'is_measurer' => true,
			'is_installer' => true,
			'is_delivery_city' => true,
			'is_delivery_region' => true,
			'is_confirmed' => true,
			'remember_token' => true,
			'created_at' => \Carbon\Carbon::now(),
			'updated_at' => \Carbon\Carbon::now()
		]);

		$faker = Faker::create('ru_RU');
		for ($i = 0; $i < 10; $i++){
			DB::table('users')->insert([
				'login' => $faker->userName,
				'name' => $faker->firstNameMale,
				'surname' => $faker->lastName,
				'patronymic' => $faker->middleNameMale,
				'birthday' => $faker->date(),
				'phone' => $faker->phoneNumber,
				'email' => $faker->email,
				'password' => bcrypt('1234abcd'),
				'comment' => $faker->address,
				'is_eax' => false,
				'is_admin' => false,
				'is_private' => true,
				'is_legal' => true,
				'is_confirmed' => true,
				'remember_token' => true,
				'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()
			]);
		}


		factory(\App\Product::class, 50)->create();
    }
}
