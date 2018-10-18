<?php

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = [
            [
                'title' => 'اخبار',
                'url' => '/content/news',
                'order' => 3,
                'location' => Menu::LOCATION_HEADER,
                'status' => Menu::STATUS_ACTIVE,
                'menu_id' => null,
                'user_id' => 1,
            ],
            [
                'title' => 'مقالات',
                'url' => '/content/article',
                'order' => 4,
                'location' => Menu::LOCATION_HEADER,
                'status' => Menu::STATUS_ACTIVE,
                'menu_id' => null,
                'user_id' => 1,
            ],
            [
                'title' => 'مقایسه محصولات',
                'url' => '/product/comparison',
                'order' => 2,
                'location' => Menu::LOCATION_HEADER,
                'status' => Menu::STATUS_ACTIVE,
                'menu_id' => null,
                'user_id' => 1,
            ],
            [
                'title' => 'پرسش و پاسخ',
                'url' => '/forum',
                'order' => 5,
                'location' => Menu::LOCATION_HEADER,
                'status' => Menu::STATUS_DEACTIVE,
                'menu_id' => null,
                'user_id' => 1,
            ],            
        ];

        foreach($menus as $menu)
        {
        	\App\Models\Menu::firstOrCreate($menu);
        }
    }
}
