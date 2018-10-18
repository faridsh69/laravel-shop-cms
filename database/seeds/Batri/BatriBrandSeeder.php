<?php

use Illuminate\Database\Seeder;
use App\Models\Brand;

class BatriBrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brands = [
        	[
        		'title' => 'Apple',
	    		'description' => 'برند معتبر اپل',
	    		'meta_title' => 'اپل - Apple',
	    		'meta_description' => 'برند معتبر اپل',
	    		'status' => Brand::STATUS_ACTIVE,
	    		'image_id' => 1,
	    		'user_id' => 1,
	    	],
	    	[ 'title' => 'Apple'],
	    	[ 'title' => 'Samsung'],
	    	[ 'title' => 'Huawei'],
	    	[ 'title' => 'LG'],
	    	[ 'title' => 'Sony'],
	    	[ 'title' => 'HTC'],
	    	[ 'title' => 'Microsoft'],
	    	[ 'title' => 'Nokia'],
	    	[ 'title' => 'Google'],
	    	[ 'title' => 'Motorola'],
	    	[ 'title' => 'ASUS'],
	    	[ 'title' => 'Lenovo'],
	    	[ 'title' => 'Xiaomi'],
	    	[ 'title' => 'Alcatel'],
	    	[ 'title' => 'GLX'],
	    	[ 'title' => 'Vsun'],
	    	[ 'title' => 'BlackBerry'],
	    	[ 'title' => 'Gigabye'],
	    	[ 'title' => 'Vaio'],
	    	[ 'title' => 'SonyEricson'],
	    	[ 'title' => 'Acer'],
	    	[ 'title' => 'Dell'],
	    	[ 'title' => 'Hyundai'],
	    	[ 'title' => 'Marshal'],
        ];

        foreach($brands as $brand)
        {
        	$brand['user_id'] = 1;
           	Brand::updateOrCreate($brand);
        }
    }
}
