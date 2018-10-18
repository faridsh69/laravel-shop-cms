<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGroupIdToAdvertisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('advertises', function (Blueprint $table) {
        //     $table->string('group_id')->nullable();
        // });
        // Schema::table('products', function (Blueprint $table) {
        //     $table->string('group_id')->nullable();
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
        //     $table->dropColumn('group_id');
        // });
        // Schema::table('products', function (Blueprint $table) {
        //     $table->dropColumn('group_id');
        // });
    }
}
