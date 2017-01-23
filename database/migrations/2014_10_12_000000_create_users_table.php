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
            $table->string('password')->default(bcrypt('12345678'));

            $table->string('login')->default('')->unique();
            $table->string('photo')->nullable();
            $table->string('name')->default('');
            $table->string('surname')->default('');
            $table->string('patronymic')->default('');
            $table->string('phone')->default('')->unique();
            $table->date('birthday')->default(date("Y-m-d"));
            $table->text('comment')->nullable();

            /*�����*/
            $table->boolean('is_eax')->default(0);			// - �������
            $table->boolean('is_admin')->default(0);		// - �����
            $table->boolean('is_private')->default(0);		// - �����
            $table->boolean('is_legal')->default(0);		// - ����
            $table->boolean('is_confirmed')->default(0);	// - ��������������
            
            /*
            dealer
            measurement
            installation
            driver
            cutting
            a guest
            */
           // $table->string('confirm_str');
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
