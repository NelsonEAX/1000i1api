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
use App\Models\Storages\Storage;
use App\Models\Storages\StorageUser;
use App\Models\Storages\StorageProduct;
use App\Models\Storages\StorageOrder;
use App\Models\Storages\StorageCategory;

$factory->define(Storage::class, function (Faker\Generator $faker) {
    $uuid = $faker->uuid;
    //$tempImage = tempnam('D:/_DEV_/domains/1000i1api/public/images/', $filename).'$uuid.jpg';
    $tempImage = public_path('storage').'/'.$uuid.'.jpg';
    copy('http://lorempixel.com/400/400/technics/', $tempImage);
    return [
        'path' => public_path('storage'),
        'name' => $faker->text($maxNbChars = 10),
        'uuid' => $uuid,
        'extension' => 'jpg',
        'show' => true,
    ];
});

$factory->define(StorageUser::class, function (Faker\Generator $faker) {
    return [
        'storage' => $faker->randomElement(Storage::pluck('id')->toArray()),
        'user' => $faker->randomElement(\App\Models\Users\User::pluck('id')->toArray()),
    ];
});

$factory->define(StorageProduct::class, function (Faker\Generator $faker) {
    return [
        'storage' => $faker->randomElement(Storage::pluck('id')->toArray()),
        'product' => $faker->randomElement(\App\Models\Products\Product::pluck('id')->toArray()),
    ];
});

$factory->define(StorageCategory::class, function (Faker\Generator $faker) {
    return [
        'storage' => $faker->randomElement(Storage::pluck('id')->toArray()),
        'category' => $faker->randomElement(\App\Models\Products\Category::pluck('id')->toArray()),
    ];
});

$factory->define(StorageOrder::class, function (Faker\Generator $faker) {
    return [
        'storage' => $faker->randomElement(Storage::pluck('id')->toArray()),
        'order' => $faker->randomElement(\App\Models\Orders\Order::pluck('id')->toArray()),
    ];
});
