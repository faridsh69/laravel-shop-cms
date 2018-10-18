<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{  
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    const PAGE_SIZE = 25;
    const MESSAGE_INSERT_SUCCESS = 'آیتم مورد نظر با موفقیت ذخیره شد.';
    const MESSAGE_UPDATE_SUCCESS = 'تغییرات شما با موفقیت ذخیره شد.';
    const MESSAGE_FAILED = 'در هنگام ثبت خطا رخ داده است.';
    const MESSAGE_DELETE_SUCCESS = 'آیتم مورد نظر با موفقیت حذف شد.';
    const MESSAGE_NOT_FOUND = 'آیتم مورد نظر یافت نشد';   
}
