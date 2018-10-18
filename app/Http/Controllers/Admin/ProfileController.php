<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Address;
use \App\Models\User;
use \App\Models\Payment;
use \App\Http\Requests\UpdateProfile;
use \App\Http\Requests\StoreAddress;
use \App\Http\Requests\ChangePassword;

class ProfileController extends Controller
{
	public function index()
    {
        return view('admin.profile.profile');
    }

    public function update(UpdateProfile $request)
	{ 
        $user = User::where('id', \Auth::id())->first();

        foreach (User::getFillables() as $key) {
            if( isset($request[$key]) ){
                $user[$key] = $request[$key];
            }
        }
        $user->save();

        if($request['brands'])
        {
            $user->brands()->sync($request['brands'], true);
        }

        \Log::info('آدرسی وارد شده با نام : '. $request['address'] . ' + by user_id: ' . \Auth::id());

        \App\Http\Controllers\ImageController::save($request['cropped_image'],$user);
        $request->session()->flash('alert-success', self::MESSAGE_UPDATE_SUCCESS);

        if($request['shop_image'])
        {
            \App\Http\Controllers\ImageController::saveProfile($request['shop_image'],$user, 'shop');
        }

        if($request['visit_image'])
        {
            \App\Http\Controllers\ImageController::saveProfile($request['visit_image'],$user, 'visit');
        }

        if($request['javaz_image'])
        {
            \App\Http\Controllers\ImageController::saveProfile($request['javaz_image'],$user, 'javaz');
        }
        return redirect()->back();
	}

    public function postAddress(StoreAddress $request)
	{
        // dd($request->all());
		$address = $request->all();
    	$address['user_id'] = \Auth::id();
        if($address['latitude'] == "latitude")
            $address['latitude'] = null;
        if($address['longitude'] == "longitude")
            $address['longitude'] = null;
		$address = Address::create($address);

        \Log::info('آدرسی وارد شده با نام : '. $request['address'] . ' + by user_id: ' . \Auth::id());
        $request->session()->flash('alert-success', self::MESSAGE_UPDATE_SUCCESS);

		return redirect()->back();
	}

    public function postChangePassword(ChangePassword $request)
    {
        User::where('id', \Auth::id() )->update([
            'password' => bcrypt($request['newpassword']),
        ]);

        $request->session()->flash('alert-success', 'رمز عبور شما با موفقیت به '. $request['newpassword'] .' تغییر یافت.');

        return redirect()->back();
    }

    public function postChargeCredit(Request $request)
    {
        // \Validator::make($request->all(), [
        //     'charge-credit' => 'required|min:1000|numeric',
        // ])->validate();
        // $price = $request['charge-credit'];

        // $payment = \App\Models\Payment::create([
        //     'user_id' => \Auth::id(),
        //     'user_ip' => \Request::ip(),
        //     'user_agent' => \Request::header('User-Agent'),
        //     'amount' => $price,
        //     'Invoice_date' => 'خرید اعتبار',
        //     'description' => 'در حال ورود به بانک',
        //     'status' => 0,
        //     ]);
        //     \Log::info('در حال ورود به بانک با خرید اعتبار: ' . $price . ' by user_id: '. \Auth::id() 
        //     . ' with payment_id: ' . $payment->id );
        // $MerchantID = self::MERCHANT_CODE;           
        // $Amount = $price; 
        // $Description = 'سفارش از ' . self::NAME;  
        // $Email = \Auth::user()->email; 
        // $Mobile = \Auth::user()->phone; 
        // $CallbackURL = url('verifyCredit'); 
          
        // // URL also Can be https://ir.zarinpal.com/pg/services/WebGate/wsdl
        // $client = new SoapClient('https://de.zarinpal.com/pg/services/WebGate/wsdl', array('encoding' => 'UTF-8')); 
          
        // $result = $client->PaymentRequest(
        //     array(
        //         'MerchantID'   => $MerchantID,
        //         'Amount'   => $Amount,
        //         'Description'   => $Description,
        //         'Email'   => $Email,
        //         'Mobile'   => $Mobile,
        //         'CallbackURL'   => $CallbackURL
        //     )
        // );

        // if($result->Status == 100)
        // {
        //     $payment->Invoice_number = $result->Authority;
        //     $payment->save();
        //     Header('Location: https://www.zarinpal.com/pg/StartPay/'.$result->Authority);exit;
        // } else {
        //     $payment->description = 'اطلاعات بانک تو سیستم غلطه';
        //     $payment->save();
        //     dd('لطفا با شماره ۰۹۱۰۶۸۰۱۶۸۵ تماس بگیرید و بگویید مشکل "اطلاعات بانک اشتباه" رخ داده است. سریعا مشکل رفع می شود',$result->Status);
        //     \Log::warning('لطفا با شماره ۰۹۱۰۶۸۰۱۶۸۵ تماس بگیرید و بگویید مشکل "اطلاعات بانک اشتباه" رخ داده است. سریعا مشکل رفع می شود',' کد خطا: '.$result->Status );
        // }
    }

}
