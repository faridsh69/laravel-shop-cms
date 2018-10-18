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
    	Schema::defaultStringLength(191);
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone')->unique();
            $table->string('password');
            $table->string('email')->nullable();
            $table->string('national_code')->nullable();
            $table->enum('gender', ['male', 'female'])->default('male');
            $table->date('birthday')->nullable();
            $table->string('used_marketer_code')->nullable();
            $table->string('generated_marketer_code')->nullable();
            $table->string('rate')->nullable();
            $table->integer('credit')->unsigned()->default(0);
            $table->tinyInteger('status')->default(1);
            $table->integer('image_id')->unsigned()->nullable();
            $table->integer('sms_code')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
