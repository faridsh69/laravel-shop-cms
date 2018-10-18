<?php

use Illuminate\Database\Seeder;
use App\Models\Baner;

class BanerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $baners = [
        	[
        		'title' => 'بنر 1',
	    		'description' => '',
	    		'link' => '/',
	    		'location' => Baner::LOCATION_RIGHT_SLIDER,
	    		'status' => Baner::STATUS_ACTIVE,
	    		'image_id' => 2,
	    	],
	    	[
        		'title' => 'بنر 2',
	    		'description' => '',
	    		'link' => '/',
	    		'location' => Baner::LOCATION_RIGHT_SLIDER,
	    		'status' => Baner::STATUS_ACTIVE,
	    		'image_id' => 3,
	    	],
	    	[
        		'title' => 'بنر 3',
	    		'description' => '',
	    		'link' => '/',
	    		'location' => Baner::LOCATION_RIGHT_SLIDER,
	    		'status' => Baner::STATUS_ACTIVE,
	    		'image_id' => 4,
	    	],

	    	[
        		'title' => 'بنر 4',
	    		'description' => '',
	    		'link' => '/',
	    		'location' => Baner::LOCATION_LEFT_SLIDER,
	    		'status' => Baner::STATUS_ACTIVE,
	    		'image_id' => 2,
	    	],
	    	[
        		'title' => 'بنر 5',
	    		'description' => '',
	    		'link' => '/',
	    		'location' => Baner::LOCATION_LEFT_SLIDER,
	    		'status' => Baner::STATUS_ACTIVE,
	    		'image_id' => 3,
	    	],
	    	[
        		'title' => 'بنر 6',
	    		'description' => '',
	    		'link' => '/',
	    		'location' => Baner::LOCATION_LEFT_SLIDER,
	    		'status' => Baner::STATUS_ACTIVE,
	    		'image_id' => 4,
	    	],
        ];

        foreach($baners as $baner)
        {
        	$baner['user_id'] = 1;
           	Baner::updateOrCreate($baner);
        }
    }
}
