<?php

use Illuminate\Database\Seeder;

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
			'is_confirmed' => true,
			'remember_token' => true,
			'created_at' => new DateTime,
			'updated_at' => new DateTime
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
			'is_confirmed' => true,
			'remember_token' => true,
			'created_at' => new DateTime,
			'updated_at' => new DateTime
		]);

		factory(\App\Product::class, 50)->create();
    }
}
