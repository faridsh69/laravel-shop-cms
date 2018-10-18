<?php

namespace App\Http\Controllers\Admin\Manage ;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeveloperController extends Controller
{
	public function __construct()
    {
        $this->middleware('can:general_manager');
    }
    public function getLog()
    {
        $logFile = file(storage_path().'/logs/laravel.log');
        $logFile = collect($logFile)->reverse();
        \Log::info('first log!');

        return view('admin.manage.developer.log')->withLog($logFile);
    }
}

	
