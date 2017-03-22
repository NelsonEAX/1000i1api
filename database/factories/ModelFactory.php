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
//use Faker\Factory as Faker;
$faker = Faker\Factory::create('ru_RU');


$factory->define(App\Models\User::class, function ($faker) {
    static $password;
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Products\Product::class, function ( $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->paragraph(random_int(1,10)),
        'model' => $faker->word,
        'weight' => $faker->randomFloat(2, 1, 100),
        'length' => $faker->randomFloat(2, 1, 100),
        'width' => $faker->randomFloat(2, 1, 100),
        'height' => $faker->randomFloat(2, 1, 100),
        'manufacturer' => 1,
    ];
});
/*
$factory->define(App\Models\Products\Manufacturer::class, function (Faker\Generator $faker) {
    return [
        'name' => 'Manufacturer '.$faker->word,
        'description' => 'Manufacturer '.$faker->paragraph(random_int(1,10)),
        'country' => 1,
        'region' => 66,
    ];
});

$factory->define(App\Models\Products\Vendor::class, function (Faker\Generator $faker) {
    return [
        'name' => 'Vendor '.$faker->word,
        'description' => 'Vendor '.$faker->paragraph(random_int(1,10)),
    ];
});

$factory->define(App\Models\Products\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->paragraph(random_int(1,10)),
    ];
});*/