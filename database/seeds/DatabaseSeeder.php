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

        if (\App::environment() !== 'production') {

            /** Тестирование доступа */
            //Админ
            DB::table('users')->insert([
                'login' => 'test_admin',
                'name' => 'Ломай',
                'lastname' => 'Меня',
                'middlename' => 'Полностью',
                'birthday' => date('1999-12-12'),
                'phone' => '+79876543210',
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
            //Тольк зареган и подтвержден
            DB::table('users')->insert([
                'login' => 'test_confirmed',
                'name' => 'Ломай',
                'lastname' => 'Меня',
                'middlename' => 'Полностью',
                'birthday' => date('1999-12-12'),
                'phone' => '+79876543210',
                'email' => 'email0@test.ru',
                'password' => bcrypt('1234abcd'),
                'comment' => 'comment',
                'is_eax' => false,
                'is_admin' => false,
                'is_private' => false,
                'is_legal' => false,
                'is_manager' => false,
                'is_manager_production' => true,
                'is_cutter' => false,
                'is_shareholder' => false,
                'is_storekeeper' => false,
                'is_dealer' => false,
                'is_franchise' => false,
                'is_agent' => false,
                'is_related' => false,
                'is_measurer' => false,
                'is_installer' => false,
                'is_delivery_city' => false,
                'is_delivery_region' => false,
                'is_confirmed' => true,
                'remember_token' => true,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]);
            //Менеджер
            DB::table('users')->insert([
                'login' => 'test_manager',
                'name' => 'Ломай',
                'lastname' => 'Меня',
                'middlename' => 'Полностью',
                'birthday' => date('1999-12-12'),
                'phone' => '+79876543211',
                'email' => 'email1@test.ru',
                'password' => bcrypt('1234abcd'),
                'comment' => 'comment',
                'is_eax' => false,
                'is_admin' => false,
                'is_private' => false,
                'is_legal' => false,
                'is_manager' => true,
                'is_manager_production' => true,
                'is_cutter' => false,
                'is_shareholder' => false,
                'is_storekeeper' => false,
                'is_dealer' => false,
                'is_franchise' => false,
                'is_agent' => false,
                'is_related' => false,
                'is_measurer' => false,
                'is_installer' => false,
                'is_delivery_city' => false,
                'is_delivery_region' => false,
                'is_confirmed' => true,
                'remember_token' => true,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]);
            //Дилер
            DB::table('users')->insert([
                'login' => 'test_dealer',
                'name' => 'Ломай',
                'lastname' => 'Меня',
                'middlename' => 'Полностью',
                'birthday' => date('1999-12-12'),
                'phone' => '+79876543212',
                'email' => 'email2@test.ru',
                'password' => bcrypt('1234abcd'),
                'comment' => 'comment',
                'is_eax' => false,
                'is_admin' => false,
                'is_private' => false,
                'is_legal' => false,
                'is_manager' => false,
                'is_manager_production' => true,
                'is_cutter' => false,
                'is_shareholder' => false,
                'is_storekeeper' => false,
                'is_dealer' => true,
                'is_franchise' => false,
                'is_agent' => false,
                'is_related' => false,
                'is_measurer' => false,
                'is_installer' => false,
                'is_delivery_city' => false,
                'is_delivery_region' => false,
                'is_confirmed' => true,
                'remember_token' => true,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]);
            /** ******************** */

            $faker = Faker::create('ru_RU');
            for ($i = 0; $i < 10; $i++) {
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


            /** ТОВАР */
            factory(\App\Models\Products\Category::class, 10)->create();
            factory(\App\Models\Products\Manufacturer::class, 20)->create();
            factory(\App\Models\Products\Vendor::class, 10)->create();
            factory(\App\Models\Products\Product::class, 50)->create();
            factory(\App\Models\Products\ProductStock::class, 20)->create();
            factory(\App\Models\Products\ProductPrice::class, 50)->create();


            /** ЗАКАЗЫ */
            factory(\App\Models\Orders\Customer::class, 30)->create();
            factory(\App\Models\Orders\Order::class, 30)->create();
            factory(\App\Models\Orders\OrderProduct::class, 30)->create();
            factory(\App\Models\Orders\Ceiling::class, 30)->create();
            factory(\App\Models\Orders\CeilingProduct::class, 30)->create();


            /** ХРАНИЛИЩЕ */
            factory(\App\Models\Storages\Storage::class, 100)->create();
        }
	}
}
