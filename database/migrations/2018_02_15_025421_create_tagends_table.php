<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tagends', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->integer('value')->unsigned()->nullable();
            $table->boolean('sign')->default(1)->comment('0 negative 1 positive');
            $table->boolean('type')->default(1)->comment('0 absolot 1 percent');
            $table->boolean('is_copon')->default(0);
            $table->string('code')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->integer('used_count')->default(1);
            $table->integer('minimum_price')->default(1);
            $table->timestamp('used_from')->nullable();
            $table->timestamp('used_to')->nullable();
            $table->integer('used_by')->unsigned()->nullable();
            $table->foreign('used_by')->references('id')->on('users');
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
        Schema::dropIfExists('tagends');
    }
}
