<?php

use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $address = [
        	'province' => 8,
    		'city' => 'تهران',
    		'address' => 'خیابان آزادی',
    		'lable' => 'شرکت',
    		'phone' => '09134125950',
    		'sabet_phone' => '02111223344',
    		'display_name' => 'فرید شهیدی',
    		'latitude' => 35.6892,
    		'longitude' => 51.3890,
    		'user_id' => 1,
        ];
        \App\Models\Address::firstOrCreate($address);
    }
}
