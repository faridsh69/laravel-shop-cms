<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [

        	// product 
        	[
        		'title' => 'دسته بندی محصولات 1',
	    		'type' => Category::TYPE_PRODUCT,
	    		'description' => 'توضیحات دسته بندی محصولات 1',
	    		'meta_title' => '',
	    		'meta_description' => '',
	    		'status' => Category::STATUS_ACTIVE,
	    		'category_id' => null,
	    		'user_id' => 1,
	    	],
	    	[
        		'title' => 'دسته بندی محصولات 2',
	    		'type' => Category::TYPE_PRODUCT,
	    	],
	    	// [
      //   		'title' => 'دسته بندی محصولات 3',
	    	// 	'type' => Category::TYPE_PRODUCT,
	    	// ],
	    	// [
      //   		'title' => 'دسته بندی محصولات 4',
	    	// 	'type' => Category::TYPE_PRODUCT,
	    	// ],
	    	// advertise
	    	[
        		'title' => 'دسته بندی آگهی 1',
	    		'type' => Category::TYPE_ADVERTISE,
	    	],
	    	[
        		'title' => 'دسته بندی آگهی 2',
	    		'type' => Category::TYPE_ADVERTISE,
	    	],
	    	[
        		'title' => 'دسته بندی آگهی 3',
	    		'type' => Category::TYPE_ADVERTISE,
	    	],
	    	[
        		'title' => 'دسته بندی آگهی 4',
	    		'type' => Category::TYPE_ADVERTISE,
	    	],
	    	// article
	    	[
        		'title' => 'تکنولوژی',
	    		'type' => Category::TYPE_ARTICLE,
	    	],
	    	[
        		'title' => 'صنعت',
	    		'type' => Category::TYPE_ARTICLE,
	    	],
	    	// news
	    	[
        		'title' => 'اقتصادی',
	    		'type' => Category::TYPE_NEWS,
	    	],
	    	[
        		'title' => 'علمی',
	    		'type' =>  Category::TYPE_NEWS,
	    	],
	    	[
        		'title' => 'حوادث',
	    		'type' =>  Category::TYPE_NEWS,
	    	],
	    	// page
	    	[
        		'title' => 'درباره ما',
	    		'type' => Category::TYPE_PAGE,
	    	],
	    	[
        		'title' => 'گارانتی',
	    		'type' => Category::TYPE_PAGE,
	    	],
	    	// forum
	    	[
        		'title' => 'دسته بندی سوالات 1',
	    		'type' => Category::TYPE_FORUM,
	    	],
	    	[
        		'title' => 'دسته بندی سوالات 2',
	    		'type' => Category::TYPE_FORUM,
	    	],
	    	[
        		'title' => 'دسته بندی سوالات 3',
	    		'type' => Category::TYPE_FORUM,
	    	],
	    	[
        		'title' => 'دسته بندی سوالات 4',
	    		'type' => Category::TYPE_FORUM,
	    	],
	    	
        ];
        foreach($categories as $category)
        {
        	$category['user_id'] = 1;
           	Category::updateOrCreate($category);
        }
    }
}
