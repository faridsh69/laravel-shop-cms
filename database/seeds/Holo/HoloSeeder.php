<?php

use Illuminate\Database\Seeder;

class HoloSeeder extends Seeder
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
            $this->call(HoloCategorySeeder::class);
        $this->call(ArticleSeeder::class);
        $this->call(NewsSeeder::class);
        $this->call(PageSeeder::class);
            $this->call(HoloBrandSeeder::class);
            $this->call(HoloFeatureSeeder::class);
            $this->call(HoloProductSeeder::class);
        $this->call(TagendSeeder::class);
        $this->call(BanerSeeder::class);
        $this->call(MenuSeeder::class);
    }
}
