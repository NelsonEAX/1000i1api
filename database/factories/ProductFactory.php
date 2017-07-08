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
use App\Models\Products\Product;
use App\Models\Products\ProductPrice;
use App\Models\Products\ProductStock;
use App\Models\Products\Category;
use App\Models\Products\Manufacturer;
use App\Models\Products\Vendor;
$faker = Faker\Factory::create('ru_RU');

$factory->define(Category::class, function (Faker\Generator $faker) {
    return [
        'name' => 'Category '.$faker->word,
        'description' => 'Category '.$faker->paragraph(random_int(1,10)),
    ];
});

$factory->define(Manufacturer::class, function (Faker\Generator$faker) {
    return [
        'name' => 'Manufacturer '.$faker->word,
        'description' => 'Manufacturer '.$faker->paragraph(random_int(1,10)),
        'country' => 1,
        'region' => 66,
    ];
});

$factory->define(Vendor::class, function (Faker\Generator $faker) {
    return [
        'name' => 'Vendor '.$faker->word,
        'description' => 'Vendor '.$faker->paragraph(random_int(1,10)),
    ];
});

$factory->define(Product::class, function (Faker\Generator $faker) {
    return [
        'category_id' => $faker->randomElement(Category::pluck('id')->toArray()),
        'manufacturer_id' => 1,
        'name' => 'Product '.$faker->word,
        'description' => 'Product '.$faker->paragraph(random_int(1,10)),
        'model' => 'Product '.$faker->word,
        'weight' => $faker->randomFloat(2, 1, 100),
        'length' => $faker->randomFloat(2, 1, 100),
        'width' => $faker->randomFloat(2, 1, 100),
        'height' => $faker->randomFloat(2, 1, 100),
    ];
});

$factory->define(ProductStock::class, function (Faker\Generator $faker) {
    return [
        'product_id' => $faker->randomElement(Product::pluck('id')->toArray()),
        'arrival' => $faker->randomDigitNotNull,
        'selling' => $faker->randomDigitNotNull,
        'vendor' => $faker->randomElement(Vendor::pluck('id')->toArray()),
    ];
});

$factory->define(ProductPrice::class, function (Faker\Generator $faker) {
    $price = $faker->randomFloat(2, 1, 100);
    return [
        'product_id' => $faker->randomElement(Product::pluck('id')->toArray()),
        'purchase' => $price,
        'wholesale' => $price + 10,
        'dealer' => $price + 30,
        'retail' => $price + 50,
        'negotiable' => $price + 20,
    ];
});

