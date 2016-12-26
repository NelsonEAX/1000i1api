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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('password');
            
            $table->string('name');
            $table->string('surname');
            $table->string('patronymic');
            $table->date('birthday');

            /*Права*/
            $table->boolean('is_eax')->default(0);			// - Владыка
            $table->boolean('is_admin')->default(0);		// - Админ
            $table->boolean('is_private')->default(0);		// - Физик
            $table->boolean('is_legal')->default(0);		// - Юрик
            $table->boolean('is_confirmed')->default(0);	// - Подтвержденный
            
            /*
            dealer
            measurement
            installation
            driver
            cutting
            a guest
            */
            $table->string('confirm_str');
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
