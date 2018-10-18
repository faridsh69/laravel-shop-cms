<?php

use Illuminate\Database\Seeder;
use \App\Models\Payment;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     //    $payment = [
    	// 	'user_id' => 1,
    	// 	'total_price' => 100,
    	// 	'user_ip' => '1231213123',
    	// 	'tref' => '123123123123123',
    	// 	'payment' => 'zarinpal',
    	// 	'error' => 'توسط مشتری کنسل شد',
    	// 	'Invoice_number' => '123',
    	// 	'Invoice_date' => date('now'),
    	// 	'factor_id' => 1,
    	// 	'description' => 'etelaate banki ghalat ast',
    	// 	'status' => Payment::STATUS_SUCCEED,
    	// ];

    	// foreach ([0,1,2,3] as $status) {
    	// 	$payment['status'] = $status;
    	// 	Payment::create($payment);
    	// }
    }
}
