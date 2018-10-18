<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('total_price')->unsigned();
            $table->string('user_ip')->nullable();
            $table->string('error')->nullable();
            $table->string('Invoice_date')->nullable();
            $table->string('description')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->integer('factor_id')->unsigned();
            $table->foreign('factor_id')->references('id')->on('factors');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            $table->string('refId')->nullable(); // شماره ارجاع بانک 00000000000000072078672
            $table->string('transaction_id')->nullable(); // شماره تراکنش 152420075508
            $table->string('tracking_code')->nullable();
            $table->string('card_number')->nullable();
            $table->string('bank')->nullable();

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
        Schema::dropIfExists('payments');
    }
}
