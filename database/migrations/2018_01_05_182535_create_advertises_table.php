<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertises', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('phone');
            $table->text('address')->nullable();
            $table->string('price_type')->nullable();
            $table->string('group_id')->nullable();
            $table->integer('price')->unsigned()->nullable();
            $table->string('noe_ghete')->nullable(); // noe ghete
            $table->string('operator')->nullable();
            $table->string('sim_cart_type')->nullable();
            $table->string('sim_cart_number')->nullable();
            $table->boolean('aggrement')->default(1);
            $table->tinyInteger('status')->default(1);
            $table->boolean('admin_seen')->default(0);
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->string('province')->nullable();
            $table->string('city')->nullable();
            $table->tinyInteger('why_not_accept_status')->unsigned()->nullable();
            $table->text('why_not_accept_text')->nullable();
            $table->integer('image_id')->unsigned()->nullable();
            $table->foreign('image_id')->references('id')->on('images');
            $table->integer('category_id')->unsigned()->nullable();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->integer('brand_id')->unsigned()->nullable();
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('advertises');
    }
}
