<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCityAndProvinceToAdvertisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('advertises', function (Blueprint $table) {
        //     $table->string('province')->nullable();
        //     $table->string('city')->nullable();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('advertises', function (Blueprint $table) {
        //     $table->dropColumn('province');
        //     $table->dropColumn('city');
        // });
    }
}
