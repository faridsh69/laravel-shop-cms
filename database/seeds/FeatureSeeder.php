<?php

use Illuminate\Database\Seeder;
use  App\Models\Feature;
use  App\Models\Category;

class FeatureSeeder extends Seeder
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
                'title' => 'وزن',
                'type' => Feature::TYPE_NUMBER,
                'unit' => 'گرم',
                'options' => null,
                'price_affected' => 0,
                'status' => Category::STATUS_ACTIVE,
                'category_id' => 1,
                'user_id' => 1,
                'group' => null,
                'filter' => 1,
                'order' => 1,
            ],
            [
                'title' => 'کد کالا',
                'type' => Feature::TYPE_STRING,
                'status' => Category::STATUS_ACTIVE,
                'category_id' => 1,
            ],
            [
                'title' => 'گارانتی',
                'type' => Feature::TYPE_BOOLEAN,
                'status' => Category::STATUS_ACTIVE,
                'category_id' => 1,
            ],
            [
                'title' => 'رنگ',
                'type' => Feature::TYPE_SELECT,
                'options' => json_encode(['سفید', 'مشکی', 'آبی', 'قرمز', 'سبز']),
                'status' => Category::STATUS_ACTIVE,
                'category_id' => 1,
            ],
            [
                'title' => 'قابلیت اتصال به',
                'type' => Feature::TYPE_MULTISELECT,
                'options' => json_encode(['موبایل', 'تلویزیون', 'کامپیوتر', 'لبتاب']),
                'status' => Category::STATUS_ACTIVE,
                'category_id' => 1,
            ],
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
