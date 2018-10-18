<?php

use Illuminate\Database\Seeder;
use \App\Models\Page;
use \App\Models\Category;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()	
    {
        $pages = [
            [
                'title' => 'گارانتی',
                'top_title' => '',
                'sub_title' => '',
                'content' => 'در روابط بازرگاني و خريد و فروش، وارانتي يا گارانتي تعهدي است که فروشنده در مقابل محصول يا خدماتي ارائه مي کند، و معمولا متعهد مي شود در صورت برآورده نشدن ادعاي خود، حاضر به تعمير يا تعويض کالا خواهد شد.
                        <br>',
                'status' => Page::STATUS_ACTIVE,
                'image_id' => 1,
                'meta_title' => 'گارانتی',
                'meta_description' => 'گارانتی',
            ],
        ];
        $category = Category::where('type',Category::TYPE_PAGE)->first();

        foreach($pages as $page)
        {
        	$page['category_id'] = $category ? $category->id : null ;
        	$page['user_id'] = 1;

            Page::firstOrCreate($page);
        }
    }
}
