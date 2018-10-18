<?php

use Illuminate\Database\Seeder;
use  App\Models\Feature;
use  App\Models\Category;

class BatriFeatureSeeder extends Seeder
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
        		'title' => 'شماره فنی',
	    		'group' => null,
	    		'unit' => null,
	    		'status' => Category::STATUS_ACTIVE,
	    		'category_id' => 1,
	    		'user_id' => 1,
	    	],
	    	[ 'title' => 'ظرفیت' ],
	    	[ 'title' => 'کمترین ظرفیت', ],
	    	[ 'title' => 'بیشترین ظرفیت' ],
	    	[ 'title' => 'مدل گوشی' ],
	    	[ 'title' => 'وزن' ],
	    	[ 'title' => 'سایز' ],
	    	[ 'title' => 'مدل‌های گوشی سازگار' ],
	    	[ 'title' => 'کیفیت' ],
	    	[ 'title' => 'سقف مجاز موجودی' ],
        ];
        $category = Category::where('type', Category::TYPE_PRODUCT)->first();

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
