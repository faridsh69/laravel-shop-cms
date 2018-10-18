<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
// use SoapClient;
// use App\Notifications\KharidKonande;
// use App\Notifications\ForgetPassword;
use App\Models\Product;
use App\Models\Article;
use App\Models\News;
use App\Models\Brand;
use App\Models\Baner;
use App\Models\User;
use App\Models\Factor;
use App\Models\Payment;

class TestController extends Controller
{
    public function postActivationCode(Request $request,User $user)
    {
        $validator = \Validator::make($request->all(), [
            'mobile' => 'required|digits:11|regex:/(09)[0-9]{9}/'
        ]);
        if ($validator->fails()) {
            $response = [
                'status' => 'failed',
                'message' => 'موبایل وارد شده معتبر نمی باشد.',
            ];
            return $response;
        }
        
        $mobile = $request->mobile;
        $activation_code = rand(1000,9999);
        $activation_code = 8319;

        $existing_user = User::where('phone', $mobile)->first();
        if($existing_user){
            $user = $existing_user;
        }
        $user->generated_marketer_code = $activation_code;
        $user->first_name = 'کاربر';
        $user->last_name = 'pass:1';
        $user->password = '1';
        $user->phone = $mobile;
        $user->save();

        $content_code = " کد فعالسازی شما: " . $activation_code . "\n" .
            "با تشکر. " . "\n" . 
            "گروه مشاورین استاد احمدی 09106801685";

        \App\Http\Services\SmsService::send($user, $content_code);

        $response = [
            'status' => 'success',
            'message' => 'کد فعال سازی ارسال شد.',
        ];
        return $response;
    }

    public function postCheckCode(Request $request)
    {
        $mobile = $request->mobile;
        $activation_code = $request->activation_code;
        
        $existing_user = User::where('phone', $mobile)->first();
        if($existing_user && $existing_user->generated_marketer_code == $activation_code){
            $response = [
                'status' => 'success',
                'message' => 'با موفقیت وارد سایت شدید!',
                'user_id' => $existing_user->id,
            ];
        }else{
            $response = [
                'status' => 'failed',
                'message' => 'کد مورد نظر اشتباه است'
            ];
        }
        return $response;
    }
    
    public function form()
    {
        return view('test.form');
    }

	public function backup() 
    {
        // $time = \Nopaad\jDate::forge( Carbon::now() )->format(' %Y/%m/%d');
        // $tables = ['users', 'products', 'factors'];
        // foreach($tables as $table)
        // {
        //     $file = '' . $table . $time . '.sql';
        //     \DB::statement("select * into outfile '$file' FROM $table");
        // }
    }
}

