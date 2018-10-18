<?php

use Illuminate\Database\Seeder;
use App\Models\Product;
class ProductSeeder extends Seeder
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
	        	'title' => 'محصول تستی 1',
	        	'price' => 45000,
	        	'inventory' => 1000,
	        	'discount_price' => 40000,
	        	'description' => 'موبایل با کلاس و با دوام اپل با ظاهری بینظیر',
	        	'meta_title' => 'موبایل ایفون s6',
	        	'meta_description' => 'موبایل با کلاس و با دوام اپل با ظاهری بینظیر',
	        	'keywords' => 'ایفون سیکس,apple,iphone 6s plus',
	        	'status' => Product::STATUS_AVAILABLE,
	        	'brand_id' => 1,
	        	'user_id' => 1,
	        	'category_id' => 1,
	        ],
        ];
        foreach($products as $product)
        {
        	$product['user_id'] = 1;
	        $product_model = Product::create($product);
        	// $product_model->images()->sync([1], false);
        }
    }
}
