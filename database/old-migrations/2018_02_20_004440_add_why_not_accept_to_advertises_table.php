<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWhyNotAcceptToAdvertisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('advertises', function (Blueprint $table) {
        //     $table->tinyInteger('why_not_accept_status')->unsigned()->nullable();
        //     $table->text('why_not_accept_text')->nullable();
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
        //     $table->dropColumn('why_not_accept_status');
        //     $table->dropColumn('why_not_accept_text');
        // });
    }
}
