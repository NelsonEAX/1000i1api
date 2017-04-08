<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/
use App\Models\Orders\Order;
use App\Models\Orders\Customer;
use App\Models\Orders\Ceiling;
use App\Models\Orders\OrderCeiling;
use App\Models\Orders\OrderCeilingProduct;
use App\Models\Orders\OrderHistory;
use App\Models\Orders\OrderProcces;
use App\Models\Orders\OrderProduct;
use App\Models\Orders\OrderState;
use App\Models\Products\Product;

$factory->define(Customer::class, function (Faker\Generator $faker) {
    return [
        'name' => 'Customer_'.$faker->firstNameMale,
        'lastname' => 'Customer_'.$faker->lastName,
        'middlename' => 'Customer_'.$faker->lastName,
        'birthday' => $faker->date(),
        'phone' => $faker->phoneNumber,
        'email' => $faker->email,
        'adres' => $faker->address,
        'comment' => $faker->address,
    ];
});

$factory->define(Order::class, function (Faker\Generator $faker) {
    return [
        'customer' => $faker->randomElement(Customer::pluck('id')->toArray()),
        'user' => $faker->randomElement(App\Models\Users\User::pluck('id')->toArray()),
    ];
});

$factory->define(Ceiling::class, function (Faker\Generator $faker) {
    return [
        'perimeter' => $faker->randomFloat(2, 1, 100),
        'area' => $faker->randomFloat(2, 1, 100),
        'json' => '{ "corner": 5, "user": 1, "params": [0,1,2,3] }',
    ];
});

$factory->define(OrderCeiling::class, function (Faker\Generator $faker) {
    return [
        'order' => $faker->randomElement(Order::pluck('id')->toArray()),
        'ceiling' => $faker->randomElement(Ceiling::pluck('id')->toArray()),
    ];
});

$factory->define(OrderProduct::class, function (Faker\Generator $faker) {
    $price = $faker->randomFloat(2, 1, 100);
    $count = $faker->randomFloat(0, 1, 100);
    return [
        'order' => $faker->randomElement(Order::pluck('id')->toArray()),
        'product' => $faker->randomElement(Product::pluck('id')->toArray()),
        'count' => $count,
        'price' => $price,
        'total' => $price*$count,
    ];
});

$factory->define(OrderCeilingProduct::class, function (Faker\Generator $faker) {
    $price = $faker->randomFloat(2, 1, 100);
    $count = $faker->randomFloat(0, 1, 100);
    return [
        'ceiling' => $faker->randomElement(Ceiling::pluck('id')->toArray()),
        'product' => $faker->randomElement(Product::pluck('id')->toArray()),
        'count' => $count,
        'price' => $price,
        'total' => $price*$count,
    ];
});
