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
    		'name' => 'Николай',
    		'surname' => 'Николаев',
    		'patronymic' => 'Викторович',
    		'birthday' => date('1989-08-18'),	
    		'email' => 'nelsoneax@yandex.ru',
    		'password' => bcrypt('abc123d4'),
    		'is_eax' => true,
    		'is_admin' => true,
    		'is_private' => true,
    		'is_legal' => true,
    		'is_confirmed' => true,
    		'remember_token' => true,
	        'created_at' => new DateTime,
	        'updated_at' => new DateTime
    	]);
    }
}
