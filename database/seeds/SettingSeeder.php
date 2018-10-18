<?php

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = \App\Http\Services\SettingService::DEFAULT_SETTINGS;
        
        foreach($settings as $setting){
            Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
