<?php

use Illuminate\Database\Seeder;
use App\Models\Product;

class BatriProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$products = [
    		[
	        	'title' => 'موبایل ایفون s6',
	        	'price' => 1950000,
	        	'inventory' => 100,
	        	'discount_price' => 1800000,
	        	'description' => 'موبایل با کلاس و با دوام اپل با ظاهری بینظیر',
	        	'meta_title' => 'موبایل ایفون s6',
	        	'meta_description' => 'موبایل با کلاس و با دوام اپل با ظاهری بینظیر',
	        	'keywords' => 'ایفون سیکس,apple,iphone 6s plus',
	        	'status' => Product::STATUS_AVAILABLE,
	        	'brand_id' => 1,
	        	'user_id' => 1,
	        	'category_id' => 2,
	        ],
	        [
	        	'title' => 'موبایل سامسونگ a9',
	        	'price' => 1950000,
	        	'inventory' => 100,
	        	'discount_price' => 1800000,
	        	'description' => 'موبایل با کلاس و با دوام اپل با ظاهری بینظیر',
	        	'meta_title' => 'موبایل ایفون s6',
	        	'meta_description' => 'موبایل با کلاس و با دوام اپل با ظاهری بینظیر',
	        	'keywords' => 'ایفون سیکس,apple,iphone 6s plus',
	        	'status' => Product::STATUS_AVAILABLE,
	        	'brand_id' => 1,
	        	'user_id' => 1,
	        	'category_id' => 2,
	        ],
	        [
	        	'title' => 'موبایل سامسونگ a8',
	        	'price' => 1950000,
	        	'inventory' => 100,
	        	'discount_price' => 1800000,
	        	'description' => 'موبایل با کلاس و با دوام اپل با ظاهری بینظیر',
	        	'meta_title' => 'موبایل ایفون s6',
	        	'meta_description' => 'موبایل با کلاس و با دوام اپل با ظاهری بینظیر',
	        	'keywords' => 'ایفون سیکس,apple,iphone 6s plus',
	        	'status' => Product::STATUS_AVAILABLE,
	        	'brand_id' => 1,
	        	'user_id' => 1,
	        	'category_id' => 2,
	        ],
	        [
	        	'title' => 'موبایل ایفون 5s plus',
	        	'price' => 1950000,
	        	'inventory' => 100,
	        	'discount_price' => 1800000,
	        	'description' => 'موبایل با کلاس و با دوام اپل با ظاهری بینظیر',
	        	'meta_title' => 'موبایل ایفون s6',
	        	'meta_description' => 'موبایل با کلاس و با دوام اپل با ظاهری بینظیر',
	        	'keywords' => 'ایفون سیکس,apple,iphone 6s plus',
	        	'status' => Product::STATUS_AVAILABLE,
	        	'brand_id' => 1,
	        	'user_id' => 1,
	        	'category_id' => 2,
	        ],
	        [
	        	'title' => 'موبایل ایفون s4',
	        	'price' => 1950000,
	        	'inventory' => 100,
	        	'discount_price' => 1800000,
	        	'description' => 'موبایل با کلاس و با دوام اپل با ظاهری بینظیر',
	        	'meta_title' => 'موبایل ایفون s6',
	        	'meta_description' => 'موبایل با کلاس و با دوام اپل با ظاهری بینظیر',
	        	'keywords' => 'ایفون سیکس,apple,iphone 6s plus',
	        	'status' => Product::STATUS_AVAILABLE,
	        	'brand_id' => 1,
	        	'user_id' => 1,
	        	'category_id' => 2,
	        ],
	        [
	        	'title' => 'موبایل ایفون s2',
	        	'price' => 1950000,
	        	'inventory' => 100,
	        	'discount_price' => 1800000,
	        	'description' => 'موبایل با کلاس و با دوام اپل با ظاهری بینظیر',
	        	'meta_title' => 'موبایل ایفون s6',
	        	'meta_description' => 'موبایل با کلاس و با دوام اپل با ظاهری بینظیر',
	        	'keywords' => 'ایفون سیکس,apple,iphone 6s plus',
	        	'status' => Product::STATUS_AVAILABLE,
	        	'brand_id' => 1,
	        	'user_id' => 1,
	        	'category_id' => 2,
	        ],
        ];
        foreach($products as $product)
        {
        	$product['user_id'] = 1;
	        $product_model = Product::create($product);
        	// $product_model->images()->sync([1], false);
        	// $product_model->features()->attach([1],['data' => 14031]);
        }
    }
}
