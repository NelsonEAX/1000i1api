<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /** ЗАКАЗЫ */
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user')->index('user')->comment('Ссылка на пользователя');
            $table->integer('customer')->index('customer')->comment('Ссылка на клиента');
            $table->timestamps();
        });

        /** ЗАКАЗЫ ТОВАРЫ */
        Schema::create('order_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order')->index('order')->comment('Ссылка на заказ');
            $table->integer('product')->index('product')->comment('Ссылка на продукт');
            $table->decimal('count', 10, 2)->comment('Количество');
            $table->decimal('price', 10, 2)->comment('Цена');
            $table->decimal('total', 10, 2)->comment('Сумма');
            $table->timestamps();
        });

        /** ЗАКАЗЫ ПОТОЛКИ */
        Schema::create('order_ceilings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order')->index('order')->comment('Ссылка на заказ');
            $table->integer('ceiling')->index('ceiling')->comment('Ссылка на потолок');
            $table->timestamps();
        });

        /** ЗАКАЗЫ ПОТОЛОК КОМПЛЕКТУЮЩИЕ */
        Schema::create('order_ceiling_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ceiling')->index('ceiling')->comment('Ссылка на потолок');
            $table->integer('product')->index('product')->comment('Ссылка на продукт');
            $table->decimal('count', 10, 2)->comment('Количество');
            $table->decimal('price', 10, 2)->comment('Цена');
            $table->decimal('total', 10, 2)->comment('Сумма');
            $table->timestamps();
        });

        /** ЗАКАЗЫ В ПРОЦЕССЕ */
        Schema::create('order_proccess', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('state')->index('state')->comment('Ссылка на состояние');
            $table->integer('user')->index('user')->comment('Ссылка на пользователя');
            $table->integer('order')->index('order')->comment('Ссылка на заказ');
            $table->timestamps();
        });

        /** ЗАКАЗЫ СОСТОЯНИЕ */
        Schema::create('order_states', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('comment', 2048);
            $table->integer('sorting')->comment('Сортировка');
            $table->boolean('enable')->default(1)->comment('');
            $table->timestamps();
        });

        /** ЗАКАЗЫ ИСТОРИЯ */
        Schema::create('order_historys', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order')->index('order')->comment('Ссылка на заказ');
            $table->integer('user')->index('user')->comment('Ссылка на пользователя');
            $table->string('method', 255);
            $table->text('sql', 65536);
            $table->string('url', 255);
            $table->timestamps();
        });

        /** ПОТОЛКИ */
        Schema::create('ceilings', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('perimeter', 10, 2)->comment('Цена');
            $table->decimal('area', 10, 2)->comment('Цена');
            $table->text('json', 65536);
            $table->timestamps();
        });

        /** КЛИЕНТЫ */
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('lastname', 45);
            $table->string('name', 45);
            $table->string('middlename', 45)->nullable();;
            $table->date('birthday')->nullable();//->default(date("Y-m-d"));
            $table->string('phone');
            $table->string('email', 45)->nullable();;
            $table->string('adres', 255);
            $table->string('comment', 2048)->nullable();;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
        Schema::dropIfExists('order_ceilings');
        Schema::dropIfExists('order_ceiling_products');
        Schema::dropIfExists('order_products');
        Schema::dropIfExists('order_states');
        Schema::dropIfExists('order_proccess');
        Schema::dropIfExists('order_historys');
        Schema::dropIfExists('ceilings');
        Schema::dropIfExists('customers');
    }
}
