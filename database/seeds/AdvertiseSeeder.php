<?php

use Illuminate\Database\Seeder;
use App\Models\Advertise;
use App\Models\Category;

class AdvertiseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$advertises = [
        	[
        		'title' => 'موبایل در حد نو A9',
	    		'description' => 'موبایل A9 اصل با رم ۸ و دوربین ۱۲ مگاپیکسل نو نو است.',
	    		'phone' => '09106801685',
	    		'address' => 'تهران - خیابان آیت الله کاشانی - خیابان بهنام ',
	    		'price_type' => Advertise::PRICE_TYPE_MAGHTO,
	    		'price' => 820000,
	    		'noe_ghete' => null,
	    		'operator' => null,
	    		'sim_cart_type' => null,
	    		'sim_cart_number' => null,
	    		'aggrement' => 1,
	    		'status' => Advertise::STATUS_ACTIVE,
	    		// 'category_id' => 2,
	    		'brand_id' => 3,
	    		'image_id' => 1,
	    		'user_id' => 1,
	    	],
	    	[
	    		'title' => 'عینک دست دوم',
	    		'description' => 'عینک دست دوم مناسب افراد عینکی با شماره آستیگمات',
	    		'phone' => '09106801685',
	    		'price_type' => Advertise::PRICE_TYPE_TAVAFOGHI,
	    		'aggrement' => 1,
	    	]
        ];
        $category = Category::where('type',Category::TYPE_ADVERTISE)->first();

        foreach($advertises as $advertise)
        {
        	$advertise['category_id'] = $category ? $category->id : null; 
           	Advertise::updateOrCreate($advertise);
        }
    }
}
