<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyLandingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::connection('mysql_potolok')->table('db_landing', function (Blueprint $table) {
    		//$table->string('land_pref')->default('');
    		$table->string('land_ya_verif')->default('')->change();
    		$table->string('land_go_verif')->default('')->change();
    		$table->string('land_post')->default('')->change();
    		$table->string('land_geo')->default('')->change();
    		//$table->string('land_adres')->default('')->change();
    		$table->text('land_rtrg')->nullable()->default(NULL)->change();
    		$table->text('land_desc_satin')->nullable()->default(NULL)->change();
    		$table->text('land_desc_glossy')->nullable()->default(NULL)->change();
    		$table->text('land_desc_matt')->nullable()->default(NULL)->change();
    		$table->text('land_desc_multi')->nullable()->default(NULL)->change();
    		$table->text('land_desc_photo')->nullable()->default(NULL)->change();
    		$table->text('land_desc_carved')->nullable()->default(NULL)->change();
    		$table->text('land_desc_tissue')->nullable()->default(NULL)->change();
    		$table->integer('land_2')->default(0)->change();
    		$table->integer('land_3')->default(0)->change();
    	});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
