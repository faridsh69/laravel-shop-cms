<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\UserRegister;
use App\Http\Requests\UserLogin;
use App\Http\Services\SmsService;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function getLogin()
    {
        return view('user.auth.login');
    }

    public function postLogin(UserLogin $request)
    {
        if($request->always == 1){
            $login_time = 1440;
        }else{
            $login_time = 30;
        }
        if (\Auth::attempt(['status' => User::STATUS_ACTIVE, 'phone' => $request['phone'], 'password' => $request['password'] ], $login_time)) {
            \App\Models\UserLogin::create([
                'user_agent' => \Request::header('User-Agent'),
                'user_ip' => \Request::ip(),
                'user_id' => \Auth::id()
                ]);
            return redirect()->intended('/');
        }else{
            \Log::error('user cant login with phone: '. $request['phone']);
            
            return redirect()->back()->withErrors('شماره همراه یا رمز عبور اشتباه است.');
        }
    }

    public function getRegister()
    {
        return view('user.auth.register');
    }

    public function postRegister(UserRegister $request)
    {
        $user = \App\Models\User::create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'phone' => $request['phone'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
        ]);
        $request->session()->flash('alert-success', 'ثبت نام شما با موفقیت انجام شد. شما با شماره همراه '.$request['phone'] .' و رمز عبور '. $request['password'] .' به سیستم وارد شدید.');
        \Log::info('user register with phone: '. $request['phone']);
        if (\Auth::attempt(['phone' => $request['phone'], 'password' => $request['password'] ], 1440 )) {
            // if(\Auth::user()->email){
            //     \Mail::to(\Auth::user()->email)->send(new \App\Mail\UserLogin());
            // }
            $sms_service = new SmsService();
            $sms_service->register($user->phone);
            
            return redirect()->intended('/');
        } 
    }

    public function postForgetPassword(Request $request)
    {
        \Validator::make($request->all(), [
            'phone' => 'required|exists:users,phone',
        ])->validate();

        $user = \App\Models\User::Active()->where('phone',$request['phone'])->first();
        if($user)
        {
            $code = rand(1000,9999);
            $user->password = bcrypt($code);
            $user->save();
            $request->session()->flash('alert-success', 'رمز عبور برای شماره همراه شما ارسال شد.');

            $sms_service = new SmsService();
            $sms_service->forgetPassword($user->phone, $code);
        }

        return redirect()->back();
    }
}
