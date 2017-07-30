<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoragesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /** ХРАНИЛИЩЕ ФАЙЛОВ */
        Schema::create('storages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable()->index('user')->comment('Ссылка на пользователя');
            $table->integer('order_id')->nullable()->index('order')->comment('Ссылка на заказ');
            $table->integer('product_id')->nullable()->index('product')->comment('Ссылка на товар');
            $table->integer('category_id')->nullable()->index('category')->comment('Ссылка на категорию товара');
            $table->string('name', 255);
            $table->string('uuid', 36);
            $table->string('extension', 10);
            $table->boolean('enable')->default(true);
            $table->timestamps();
        });

        /** ХРАНИЛИЩЕ ФАЙЛОВ ПОЛЬЗОВАТЕЛЕЙ*/
        /*Schema::create('storage_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('storage')->index('storage')->comment('Ссылка на хранилище');
            $table->integer('user')->index('user')->comment('Ссылка на пользователя');
            $table->timestamps();
        });*/

        /** ХРАНИЛИЩЕ ФАЙЛОВ ЗАКАЗОВ*/
        /*Schema::create('storage_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('storage')->index('storage')->comment('Ссылка на хранилище');
            $table->integer('order')->index('order')->comment('Ссылка на заказ');
            $table->timestamps();
        });*/

        /** ХРАНИЛИЩЕ ФАЙЛОВ ПРОДУКЦИИ/ТОВАРОВ */
        /*Schema::create('storage_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('storage')->index('storage')->comment('Ссылка на хранилище');
            $table->integer('product')->index('product')->comment('Ссылка на товар');
            $table->timestamps();
        });*/

        /** ХРАНИЛИЩЕ ФАЙЛОВ КАТЕГОРИЙ */
        /*Schema::create('storage_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('storage')->index('storage')->comment('Ссылка на хранилище');
            $table->integer('category')->index('category')->comment('Ссылка на категорию товара');
            $table->timestamps();
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('storages');
        /*Schema::dropIfExists('storage_users');
        Schema::dropIfExists('storage_orders');
        Schema::dropIfExists('storage_products');
        Schema::dropIfExists('storage_categories');*/
    }
}
