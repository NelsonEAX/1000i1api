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
use App\Models\Orders\CeilingProduct;
use App\Models\Orders\OrderLog;
use App\Models\Orders\OrderProcess;
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
        'customer_id' => $faker->randomElement(Customer::pluck('id')->toArray()),
    ];
});

$factory->define(Ceiling::class, function (Faker\Generator $faker) {
    return [
        'order_id' => $faker->randomElement(Order::pluck('id')->toArray()),
        'perimeter' => $faker->numberBetween(1, 1000),
        'area' => $faker->numberBetween(1, 1000),
        'json' => '{ "corner": 5, "user": 1, "params": [0,1,2,3] }',
    ];
});

$factory->define(OrderProduct::class, function (Faker\Generator $faker) {
    $price = $faker->numberBetween(1, 1000);
    $quantity = $faker->numberBetween(1, 100);
    return [
        'order_id' => $faker->randomElement(Order::pluck('id')->toArray()),
        'product_id' => $faker->randomElement(Product::pluck('id')->toArray()),
        'quantity' => $quantity,
        'price' => $price,
        'total' => $price*$quantity,
    ];
});

$factory->define(CeilingProduct::class, function (Faker\Generator $faker) {
    $price = $faker->numberBetween(1, 1000);
    $quantity = $faker->numberBetween(1, 100);
    return [
        'ceiling_id' => $faker->randomElement(Ceiling::pluck('id')->toArray()),
        'product_id' => $faker->randomElement(Product::pluck('id')->toArray()),
        'quantity' => $quantity,
        'price' => $price,
        'total' => $price*$quantity,
    ];
});

