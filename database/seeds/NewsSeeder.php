<?php

use Illuminate\Database\Seeder;
use \App\Models\News;
use \App\Models\Category;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()	
    {
        $newses = [
            [
            	'title' => 'گسترش فروش اینترنتی',
            	'content' => 'خرید اینترنتی در کشور ما پیشرفت بسیاری داشته است و هر روز رشد بیشتری میکند، طبق آمار بانک مرکزی تراکنش های آنلاین در سالهای اخیر، هر سال 50% رشد داشته است. ابتدا بیشتر خرید اینترنتی در ایران مربوط به وسایل دیجیتال مانند موبایل و لپ‌تاپ بود اما اخیرا محصولات دیگری مانند پوشاک، محصولات بهداشتی، لوازم آشپزخانه و ... هم خرید اینترنتی آنها بسیار شده است.',
            	'user_id' => 1,
            	'status' => News::STATUS_ACTIVE,
            	'image_id' => 1,
            	'meta_title' => 'گسترش فروش اینترنتی',
            	'meta_description' => 'گسترش فروش اینترنتی',
            ],
            [
                'title' => 'پیش بینی فروش در کسب و کارهای جدید',
                'content' => 'پیش بینی فروش در کسب وکارهای جدید از طریق قضاوت منطقی و یافته های پژوهش بازار بدست می آید. هر کسب و کاری در ابتدای شروع به کار انتظاراتی از میزان جذب مشتریان جدید دارد و بسیار بدیهی است که پیش بینی های فروش در کسب و کارهای جدید با انچه در واقعیت اتفاق می افتد فاصله داشته باشد اما به یاد داشته باشید ثبت و محاسبه ی این انحرافات به شما در پیش بینی های آینده بسیار کمک خواهد نمود.',
                'user_id' => 1,
                'status' => News::STATUS_ACTIVE,
                'image_id' => 1,
                'meta_title' => 'پیش بینی فروش در کسب و کارهای جدید',
                'meta_description' => 'پیش بینی فروش در کسب و کارهای جدید',
            ]
        ];
        $category = Category::where('type',Category::TYPE_NEWS)->first();

        foreach($newses as $news)
        {
        	$news['category_id'] = $category->id;
        	$news['user_id'] = 1;

            News::firstOrCreate($news);
        }
    }
}
