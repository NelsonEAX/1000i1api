<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /** ПОЛЬЗОВАТЕЛИ */
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('password')->default(bcrypt('12345678'));

            $table->string('login')->default('');//->unique();
            $table->string('photo')->nullable();
            $table->string('lastname')->default('');
            $table->string('name')->default('');
            $table->string('middlename')->default('');
            $table->string('phone')->default('');//->unique();
            $table->date('birthday')->default(date("Y-m-d"));
            $table->text('comment')->nullable();

            /** Права */
            $table->boolean('is_eax')->default(0)->comment('Владыка');
            $table->boolean('is_admin')->default(0)->comment('Админ');
            $table->boolean('is_private')->default(0)->comment('Физ.Лицо');
            $table->boolean('is_legal')->default(0)->comment('Юр.Лицо');

            /** Собственные */
            $table->boolean('is_manager')->default(0)->comment('Менеджер по звонкам');
            $table->boolean('is_manager_production')->default(0)->comment('Менеджер цеха');
            $table->boolean('is_cutter')->default(0)->comment('Кройщик');
            $table->boolean('is_shareholder')->default(0)->comment('Пайщик');
            $table->boolean('is_storekeeper')->default(0)->comment('Кладовщик');

            /** Внешние */
            $table->boolean('is_dealer')->default(0)->comment('Дилер');
            $table->boolean('is_franchise')->default(0)->comment('Франшиза');
            $table->boolean('is_agent')->default(0)->comment('Агент');
            $table->boolean('is_related')->default(0)->comment('Смежник');

            $table->boolean('is_measurer')->default(0)->comment('Замерщик');
            $table->boolean('is_installer')->default(0)->comment('Монтажник');
            $table->boolean('is_delivery_city')->default(0)->comment('Доставщик по городу');
            $table->boolean('is_delivery_region')->default(0)->comment('Доставщик по городу');

            // $table->string('confirm_str');
            $table->boolean('is_confirmed')->default(0)->comment('Подтвержден');
            $table->string('email_token')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        /** ПОЛЬЗОВАТЕЛИ БОНУСЫ */
        Schema::create('user_points', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index('user_id')->comment('Ссылка на пользователя');
            $table->decimal('inc', 10, 2)->comment('Приход');
            $table->decimal('dec', 10, 2)->comment('Расход');
            $table->string('destination', 255);
            $table->timestamps();
        });

        /** ПОЛЬЗОВАТЕЛИ ДЕНЬГИ */
        Schema::create('user_moneys', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user')->index('user_id')->comment('Ссылка на пользователя');
            $table->decimal('inc', 10, 2)->comment('Приход');
            $table->decimal('dec', 10, 2)->comment('Расход');
            $table->string('destination', 255);
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
        Schema::dropIfExists('users');
        Schema::dropIfExists('user_points');
        Schema::dropIfExists('user_moneys');
    }
}
