<?php

use Illuminate\Database\Seeder;
use App\Models\Brand;

class HoloBrandSeeder extends Seeder
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
        		'title' => 'هلو',
	    		'description' => '',
	    		'meta_title' => '',
	    		'meta_description' => '',
	    		'status' => Brand::STATUS_ACTIVE,
	    		'image_id' => 1,
	    		'user_id' => 1,
	    	],
        ];

        foreach($brands as $brand)
        {
        	$brand['user_id'] = 1;
           	Brand::updateOrCreate($brand);
        }
    }
}
