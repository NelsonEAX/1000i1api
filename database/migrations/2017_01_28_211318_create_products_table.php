<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /** ТОВАР */
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->index('category_id')->comment('Ссылка на категорию');
            $table->integer('manufacturer_id')->nullable()->index('manufacturer_id')->comment('Ссылка на производителя');
            $table->string('name', 255)->index('name');
            $table->string('description', 2048)->nullable();
            $table->string('model', 45)->nullable()->index('model');
            $table->string('color', 45)->nullable()->comment('Цвет');
            $table->integer('weight')->nullable()->comment('Вес (гр)');
            $table->integer('length')->nullable()->comment('Длина (мм)');
            $table->integer('width')->nullable()->comment('Ширина (мм)');
            $table->integer('height')->nullable()->comment('Высота (мм)');
            $table->integer('orderby')->default(100)->comment('Порядок');
            $table->boolean('enable')->default(1)->comment('Активность');
            $table->timestamps();
            $table->softDeletes();
        });

        /** ТОВАР НА СКЛАДЕ */
        Schema::create('product_stocks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->index('product_id')->comment('Ссылка на продукт');
            $table->integer('arrival')->comment('Приход, количество');
            $table->integer('selling')->comment('Расход, количество');
            $table->integer('vendor')->index('vendor')->comment('Ссылка на поставщика');
            $table->timestamps();
            $table->softDeletes();
        });

        /** ТОВАР ЦЕНЫ */
        Schema::create('product_prices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->index('product_id')->comment('Ссылка на продукт');
            $table->integer('purchase')->comment('Закупочная');
            $table->integer('wholesale')->comment('Оптовая');
            $table->integer('dealer')->comment('Дилерская');
            $table->integer('retail')->comment('Розничная');
            $table->integer('negotiable')->comment('Договорная');
            $table->timestamps();
            $table->softDeletes();
        });

        /** КАТЕГОРИЯ */
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('description', 2048)->nullable();
            $table->integer('orderby')->default(100)->comment('Порядок');
            $table->boolean('enable')->default(1)->comment('Активность');
            $table->timestamps();
            $table->softDeletes();
        });

        /** СВЯЗЬ ТОВАР-КАТЕГОРИЯ */
        /*Schema::create('product_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product')->index('product')->comment('Ссылка на продукт');
            $table->integer('category')->index('category')->comment('Ссылка на категорию');
            $table->timestamps();
        });*/

        /** ПРОИЗВОДИТЕЛЬ */
        Schema::create('manufacturers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('description', 2048);
            $table->integer('country')->index('country')->comment('Ссылка на страну');
            $table->integer('region')->index('region')->comment('Ссылка на регион');
            $table->timestamps();
            $table->softDeletes();
        });

        /** ПОСТАВЩИК */
        Schema::create('vendors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('description', 2048);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('product_categories');
        Schema::dropIfExists('product_stocks');
        Schema::dropIfExists('product_prices');
        Schema::dropIfExists('vendors');
        Schema::dropIfExists('manufacturers');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('products');
    }
}
