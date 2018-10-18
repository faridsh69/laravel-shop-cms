<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class HoloCategorySeeder extends Seeder
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
        		'title' => 'فروشگاهی',
	    		'type' => Category::TYPE_PRODUCT,
	    		'description' => 'فروشگاهی',
	    		'meta_title' => 'نرم افزار هلو فروشگاهی',
	    		'meta_description' => 'نرم افزار هلو فروشگاهی',
	    		'status' => Category::STATUS_ACTIVE,
	    		'category_id' => null,
	    	],
	    	[
        		'title' => 'شرکتی',
	    		'type' => Category::TYPE_PRODUCT,
	    		'status' => Category::STATUS_DEACTIVE,
	    	],
	    	[
        		'title' => 'تولیدی',
	    		'type' => Category::TYPE_PRODUCT,
	    		'status' => Category::STATUS_DEACTIVE,
	    	],
	    	[
        		'title' => 'جامع',
	    		'type' => Category::TYPE_PRODUCT,
	    		'status' => Category::STATUS_DEACTIVE,
	    	],
	    	[
        		'title' => 'سایر',
	    		'type' => Category::TYPE_PRODUCT,
	    		'status' => Category::STATUS_DEACTIVE,
	    	],
	    	// advertise
	    	[
        		'title' => 'هلوکار هستم',
	    		'type' => Category::TYPE_ADVERTISE,
	    		'status' => Category::STATUS_DEACTIVE,
	    	],
	    	[
        		'title' => 'هلوکار میخواهم',
	    		'type' => Category::TYPE_ADVERTISE,
	    	],
	    	// article
	    	[
        		'title' => 'حسابداری',
	    		'type' => Category::TYPE_ARTICLE,
	    	],
	    	[
        		'title' => 'بازارکار',
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
        		'title' => 'خرید و فروش',
	    		'type' => Category::TYPE_FORUM,
	    	],
	    	[
        		'title' => 'پشتیبانی',
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
