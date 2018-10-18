<?php

use Illuminate\Database\Seeder;

class BatriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SettingSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ImageSeeder::class);
        $this->call(AddressSeeder::class);
            $this->call(BatriCategorySeeder::class);
        $this->call(ArticleSeeder::class);
        $this->call(NewsSeeder::class);
        $this->call(PageSeeder::class);
            $this->call(BrandSeeder::class);
            $this->call(FeatureSeeder::class);
            $this->call(ProductSeeder::class);
        $this->call(TagendSeeder::class);
        $this->call(BanerSeeder::class);
        $this->call(MenuSeeder::class);
    }
}
