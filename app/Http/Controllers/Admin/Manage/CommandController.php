<?php

namespace App\Http\Controllers\Admin\Manage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Artisan;

class CommandController extends Controller
{
    public function backupRun()
    {
        try {
            echo '<br>php artisan backup running...';
            // Artisan::call('backup:run');
            echo '<br>php artisan backup completed<br>';
            echo '<a href="' . storage_path('app/cms/2018-06-22-102155.zip') . '" target="_blank">download backup</a>';
        } catch (Exception $e) {
            Response::make($e->getMessage(), 500);
        }
    }

    public function configCache()
    {
        try {
            echo '<br>php artisan config:cache...';
            Artisan::call('config:cache');
            echo '<br>php artisan config:cache completed';
        } catch (Exception $e) {
            Response::make($e->getMessage(), 500);
        }
    }

    public function cacheClear()
    {
        try {
            echo '<br>php artisan cache:clear...';
            Artisan::call('cache:clear');
            echo '<br>php artisan cache:clear completed';
        } catch (Exception $e) {
            Response::make($e->getMessage(), 500);
        }
    }

    

    public function dbSeed()
    {
        try {
            echo '<br>php artisan db:seed...';
            Artisan::call('db:seed');
            echo '<br>php artisan db:seed completed';
        } catch (Exception $e) {
            Response::make($e->getMessage(), 500);
        }
    }

    public function migrate()
    {        
        try {
            echo '<br>php artisan migrate...';
            Artisan::call('migrate');
            echo '<br>php artisan migrate completed';
        } catch (Exception $e) {
            Response::make($e->getMessage(), 500);
        }
    }  
}
