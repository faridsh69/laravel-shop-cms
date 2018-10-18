<?php


namespace App\Http\Services;

use App\Http\Services\SettingService;

class SmsService extends BaseService
{
	public $setting;
	public $end_content;

	// shopping(factor);
	// send(phone, content);
	// forgetPassword(phone, code);
	// register(phone)

	public function __construct()
    {
		$this->setting = SettingService::setting();
		$this->end_content = "با تشکر. " . "\n" . $this->setting['name'];
    }

	public function shopping($factor)
	{
		$content = $this->setting['shopping_sms'] . "\n" .
			" شماره پیگیری شما: " . $factor->id . "\n" .
		  	$this->end_content;

		$phone = $factor->user->phone;
		$this->send($phone, $content);

		$content_shop = $this->setting['shopping_sms'] . "\n" .
			" شماره پیگیری شما: " . $factor->id . "\n" .
		  	$this->end_content;
		$phone_shop = $this->setting['mobile'];

		$this->send($phone_shop, $content_shop);
	}

	public function forgetPassword($phone, $code)
	{
		$content = " رمز عبور جدید شما: " . $code . "\n" .
			$this->end_content;

		$this->send($phone, $content);
	}

	public function register($phone)
	{
		$content = $this->setting['register_sms'] . "\n" . 
			$this->end_content;

		$this->send($phone, $content);
	}

    public function send($phone, $content)
    {
        ini_set("soap.wsdl_cache_enabled", "0");
        $sms_client = new \SoapClient(
            $this->setting['sms_url']
            , array('encoding'=>'UTF-8'));
        try 
        {
            $x = $sms_client->SendSMS([ 
                'userName' => $this->setting['sms_user'],
                'password' => $this->setting['sms_pass'],
                'fromNumber' => $this->setting['sms_phone'],
                'toNumbers' => [$phone],
                'messageContent' => $content,
                'isFlash' => false,
                'recId' => [],
                ]);
            \Log::info('sms با متن ' . $content . ' به شماره ' . $phone . ' ارسال شد با نتیجه: ' . $x->SendSMSResult);
        } 
        catch (Exception $e) 
        {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    // private function _random_string()
    // {
    //     $characters = '123456789';
    //     $randstring = '';
    //     for ($i = 0; $i < 3; $i++) {
    //         $randstring .= $characters[rand(0, strlen($characters)-1)];
    //     }
    //     return $randstring;
    // }

}
