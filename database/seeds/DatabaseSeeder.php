<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
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
    	DB::table('users')->insert([
			'login' => 'NelsonEAX',
			'name' => 'Николай',
			'lastname' => 'Николаев',
			'middlename' => 'Викторович',
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
			'lastname' => 'Яковлев',
			'middlename' => 'Олегович',
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
		DB::table('users')->insert([
			'login' => 'tester',
			'name' => 'Владимир',
			'lastname' => 'Яковлев',
			'middlename' => 'Олегович',
			'birthday' => date('1999-01-01'),
			'phone' => '9876543210',
			'email' => 'email@test.ru',
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
				'lastname' => $faker->lastName,
				'middlename' => $faker->middleNameMale,
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

		if (\App::environment() !== 'production') {
			/** ТОВАР */
			factory(\App\Models\Products\Product::class, 50)->create();
			factory(\App\Models\Products\Manufacturer::class, 20)->create();
			factory(\App\Models\Products\Vendor::class, 10)->create();
			factory(\App\Models\Products\Category::class, 10)->create();
			factory(\App\Models\Products\ProductCategory::class, 25)->create();
			factory(\App\Models\Products\ProductStock::class, 20)->create();
			factory(\App\Models\Products\ProductPrice::class, 50)->create();


			/** ЗАКАЗЫ */
			factory(\App\Models\Orders\Customer::class, 30)->create();
			factory(\App\Models\Orders\Order::class, 30)->create();
			factory(\App\Models\Orders\Ceiling::class, 30)->create();
			factory(\App\Models\Orders\OrderCeiling::class, 30)->create();
			factory(\App\Models\Orders\OrderCeilingProduct::class, 30)->create();
			factory(\App\Models\Orders\OrderProduct::class, 30)->create();


			/** ХРАНИЛИЩЕ */
			factory(\App\Models\Storages\Storage::class, 40)->create();
			factory(\App\Models\Storages\StorageCategory::class, 10)->create();
			factory(\App\Models\Storages\StorageOrder::class, 10)->create();
			factory(\App\Models\Storages\StorageProduct::class, 10)->create();
			factory(\App\Models\Storages\StorageUser::class, 10)->create();
		}
	}
}
