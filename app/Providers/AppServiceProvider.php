<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Services\SettingService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \View::share('constant', \App\Http\Services\SettingService::setting());
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
