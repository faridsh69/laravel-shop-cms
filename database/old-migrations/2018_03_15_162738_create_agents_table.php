<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('agents', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->text('description')->nullable();
        //     $table->tinyInteger('status')->default(1);
        //     $table->integer('user_id')->unsigned()->nullable();
        //     $table->foreign('user_id')->references('id')->on('users');
        //     $table->integer('brand_id')->unsigned()->nullable();
        //     $table->foreign('brand_id')->references('id')->on('brands');
        //     $table->integer('image_id')->unsigned()->nullable();
        //     $table->foreign('image_id')->references('id')->on('images');
        //     $table->integer('address_id')->unsigned()->nullable();
        //     $table->foreign('address_id')->references('id')->on('addresses');
        //     $table->timestamps();
        //     $table->softDeletes();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('agents');
    }
}
