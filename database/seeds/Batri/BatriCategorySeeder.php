<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class BatriCategorySeeder extends Seeder
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
        		'title' => 'باتری',
	    		'type' => Category::TYPE_PRODUCT,
	    		'description' => 'باتری',
	    		'meta_title' => 'باتری',
	    		'meta_description' => 'باتری',
	    		'status' => Category::STATUS_ACTIVE,
	    		'category_id' => null,
	    		'user_id' => 1,
	    	],
	    	[
        		'title' => 'گوشی موبایل',
	    		'type' => Category::TYPE_PRODUCT,
	    	],
	    	[
        		'title' => 'قطعات',
	    		'type' => Category::TYPE_PRODUCT,
	    	],
	    	[
        		'title' => 'لوازم جانبی',
	    		'type' => Category::TYPE_PRODUCT,
	    	],
	    	[
        		'title' => 'سیم کارت',
	    		'type' => Category::TYPE_PRODUCT,
	    	],
	    	[
        		'title' => 'تعمیرات',
	    		'type' => Category::TYPE_PRODUCT,
	    	],
	    	// advertise
	    	[
        		'title' => 'گوشی موبایل',
	    		'type' => Category::TYPE_ADVERTISE,
	    	],
	    	[
        		'title' => 'قطعات',
	    		'type' => Category::TYPE_ADVERTISE,
	    	],
	    	[
        		'title' => 'لوازم جانبی',
	    		'type' => Category::TYPE_ADVERTISE,
	    	],
	    	[
        		'title' => 'سیم کارت',
	    		'type' => Category::TYPE_ADVERTISE,
	    	],
	    	[
        		'title' => 'RAM و فلش',
	    		'type' => Category::TYPE_ADVERTISE,
	    	],
	    	// article
	    	[
        		'title' => 'موبایل',
	    		'type' => Category::TYPE_ARTICLE,
	    	],
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
        		'title' => 'تکنولوژی',
	    		'type' => Category::TYPE_NEWS,
	    	],
	    	[
        		'title' => 'جهان',
	    		'type' =>  Category::TYPE_NEWS,
	    	],
	    	[
        		'title' => 'ایران',
	    		'type' =>  Category::TYPE_NEWS,
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
	    	[
        		'title' => 'تماس با ما',
	    		'type' => Category::TYPE_PAGE,
	    	],
	    	// forum
	    	[
        		'title' => 'گوشی موبایل',
	    		'type' => Category::TYPE_FORUM,
	    	],
	    	[
        		'title' => 'قطعات',
	    		'type' => Category::TYPE_FORUM,
	    	],
	    	[
        		'title' => 'لوازم جانبی',
	    		'type' => Category::TYPE_FORUM,
	    	],
	    	[
        		'title' => 'سیم کارت',
	    		'type' => Category::TYPE_FORUM,
	    	],
	    	[
        		'title' => 'RAM و فلش',
	    		'type' => Category::TYPE_FORUM,
	    	],
	    	
        ];
        foreach($categories as $category)
        {
           Category::updateOrCreate($category);
        }
    }
}
