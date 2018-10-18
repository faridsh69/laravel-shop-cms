<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('payments', function (Blueprint $table) {
            // $table->string('refId')->nullable(); // شماره ارجاع بانک 00000000000000072078672
            // $table->string('transaction_id')->nullable(); // شماره تراکنش 152420075508
            // $table->string('tracking_code')->nullable();
            // $table->string('card_number')->nullable();
            // $table->string('bank')->nullable();

            // $table->dropColumn('payment');
            // $table->dropColumn('tref');
            // $table->dropColumn('Invoice_number');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('payments', function (Blueprint $table) {
            // $table->dropColumn('refId'); // شماره ارجاع بانک 00000000000000072078672
            // $table->dropColumn('transaction_id'); // شماره تراکنش 152420075508
            // $table->dropColumn('tracking_code');
            // $table->dropColumn('card_number');
            // $table->dropColumn('bank');

            // $table->string('payment')->nullable();
            // $table->string('tref')->nullable();
            // $table->string('Invoice_number')->nullable();
        // });
    }
}
