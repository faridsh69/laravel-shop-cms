<?php

use Illuminate\Database\Seeder;
use  App\Models\Feature;
use  App\Models\Category;

class HoloFeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $features = [
        	[
        		'title' => 'مزایا',
                'type' => Feature::TYPE_STRING,
	    		'group' => null,
	    		'unit' => null,
	    		'status' => Category::STATUS_ACTIVE,
	    		'category_id' => 1,
	    	],
	    	[ 'title' => 'مناسب برای' ],
        ];
        $category = Category::where('type', Category::TYPE_PRODUCT)->where('title', 'فروشگاهی')->first();

        foreach($features as $feature)
        {
        	if ($category){
	        	$feature['category_id'] = $category->id;
        	}
        	$feature['user_id'] = 1;
            Feature::updateOrCreate($feature);
        }
    }
}
