<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertiseImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertise_image', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('advertise_id')->unsigned();
            $table->foreign('advertise_id')->references('id')->on('advertises');
            $table->integer('image_id')->unsigned();
            $table->foreign('image_id')->references('id')->on('images');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advertise_image');
    }
}
