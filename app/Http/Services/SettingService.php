<?php

namespace App\Http\Services;

use App\Http\Services\BaseService;
use App\Models\Setting;

class SettingService extends BaseService
{
    public static function setting() 
    {
        try{
            if( class_exists('Config') && class_exists('Cache') )
            {
                $cache_settings = \Cache::remember('constant', 10, function () {
                    return Setting::pluck('value','key');
                });
                return $cache_settings;
            }
            else
            {
                $settings = self::DEFAULT_SETTINGS;
                $default_setting = collect($settings)->pluck('value', 'key');
                return $default_setting;
            }
        } 
        catch(\Exception $e){
            $settings = self::DEFAULT_SETTINGS;
            $default_setting = collect($settings)->pluck('value', 'key');
            return $default_setting;
        }
    }

    // public static function setting()
    // {
    //     \Cache::forget('constant');
    //     if( class_exists('Config') && \Schema::hasTable('settings') ){
    //         $cache_settings = \Cache::remember('constant', 10, function () {
    //             return Setting::pluck('value','key');
    //         });
    //         return $cache_settings;
    //     }
    //     $settings = self::DEFAULT_SETTINGS;
    //     $default_setting = collect($settings)->pluck('value', 'key');
    //     return $default_setting;

        // catch (\Illuminate\Database\QueryException $exception) {
        //     dd('QueryException');
        // }
        // catch (\PDOException $exception) {
        //     dd('PDOException');
        // }
        // catch (\Throwable $exception) {
        //     dd('Throwable exception');
        // }
    // }

    const DEFAULT_SETTINGS = [
        [
            'key' => 'name',
            'value' => 'فروشگاه اینترنتی ',
            'description' => 'نام سامانه',
        ],
        [
            'key' => 'description',
            'value' => 'فروشگاه اینترنتی شکیل و ساده با سرعت بالا و کاربری آسان.',
            'description' => 'توضیحات',
        ],
        [
            'key' => 'phone',
            'value' => '09106801685',
            'description' => 'تلفن دفتر',
        ],
        [
            'key' => 'mobile',
            'value' => '09106801685',
            'description' => 'شماره همراه',
        ],
        [
            'key' => 'email',
            'value' => 'farid.sh69xx@gmail.com',
            'description' => 'ایمیل',
        ],
        [
            'key' => 'fax',
            'value' => '021661246',
            'description' => 'فکس',
        ],
        [
            'key' => 'address',
            'value' => 'تهران- خییابان کاشانی - کوچه بهنام',
            'description' => 'آدرس دفتر',
        ],
        [
            'key' => 'telegram',
            'value' => 'vahabbatri',
            'description' => 'آدرس تلگرام',
        ],
        [
            'key' => 'instagram',
            'value' => 'vahabbatri',
            'description' => 'آدرس اینستاگرام',
        ],
        [
            'key' => 'card_number',
            'value' => '6037-6916-6097-xxxx',
            'description' => 'شماره کارت فروشگاه',
        ],
        [
            'key' => 'payment_local',
            'value' => 'yes',
            'description' => 'پرداخت در محل',
        ],
        [
            'key' => 'account_number',
            'value' => '1302502550221',
            'description' => 'شماره حساب فروشگاه',
        ],
        [
            'key' => 'merchant_code',
            'value' => '213124123',
            'description' => 'کد مشتری درگاه بانک',
        ],
        [
            'key' => 'terminal_code',
            'value' => '213124123',
            'description' => 'کد ترمینال درگاه بانک',
        ],
        [
            'key' => 'zarin_pal',
            'value' => 'ea12b276-429a-11e7-a249-005056a205be',
            'description' => 'درگاه زرین بال',
        ],
        [
            'key' => 'email_sender',
            'value' => 'farid.sh69@gmail.com',
            'description' => 'ایمیل مختص ارسالی به کاربران',
        ],
        [
            'key' => 'email_sender_password',
            'value' => 'ccixkuedlxpbizda',
            'description' => 'رمز ایمیل مختص ارسالی به کاربران',
        ],
        [
            'key' => 'sms_user',
            'value' => 's.farid.sh69',
            'description' => 'نام کاربری پنل اس ام اس',
        ],
        [
            'key' => 'sms_pass',
            'value' => '39026',
            'description' => 'رمز عبور پنل اس ام اس',
        ],
        [
            'key' => 'sms_phone',
            'value' => '50005708616261',
            'description' => 'شماره پنل اس ام اس',
        ],
        [
            'key' => 'sms_url',
            'value' => 'http://payamak-service.ir/SendService.svc?wsdl',
            'description' => 'url server sms',
        ],
        [
            'key' => 'logo',
            'value' => '/upload/images/logo.png',
            'description' => 'لوگو',
        ],
        [
            'key' => 'default_image',
            'value' => '/upload/images/default.png',
            'description' => 'عکس پیش فرض در سیستم',
        ],
        [
            'key' => 'default_image_user',
            'value' => '/upload/images/default_user.png',
            'description' => 'عکس پیش فرض در سیستم',
        ],
        [
            'key' => 'default_image_product',
            'value' => '/upload/images/default_product.png',
            'description' => 'عکس پیش فرض در سیستم',
        ],
        [
            'key' => 'favicon',
            'value' => '/upload/images/favicon.png',
            'description' => 'لوگو روی تب',
        ],
        [
            'key' => 'enamad',
            'value' => '123124123123123',
            'description' => 'کد اعتماد الکترونیکی',
        ],
        [
            'key' => 'google_analytics',
            'value' => 'UA-97891904-1',
            'description' => 'کد گوگل آنالیتیکس',
        ],
        [
            'key' => 'crisp',
            'value' => null,
            'description' => 'چت آنلاین کریسپ UA-97891904-1',
        ],
        [
            'key' => 'latitude',
            'value' => '35.710312',
            'description' => 'عرض جغرافیایی',
        ],
        [
            'key' => 'longitude',
            'value' => '53.398241',
            'description' => 'طول جغرافیایی',
        ],
        [
            'key' => 'register_sms',
            'value' => 'شما با موفقیت در سایت ثبت نام کردید. ',
            'description' => 'اس ام اس ارسالی در موقع ثبت نام',
        ],
        [
            'key' => 'register_email',
            'value' => 'با سلام. \n به فروشگاه خود خوش آمدید',
            'description' => 'ایمیل ارسالی در موقع ثبت نام',
        ],
        [
            'key' => 'shopping_sms',
            'value' => 'سفارش شما در سیستم ثبت شد. مسولین در حال آماده سازی کالاها می باشند.',
            'description' => 'اس ام اس ارسالی در موقع ثبت سفارش',
        ],
        [
            'key' => 'shopping_email',
            'value' => 'سفارش شما در سیستم ثبت شد. مسولین در حال آماده سازی کالاها می باشند.',
            'description' => 'ایمیل ارسالی در موقع ثبت سفارش',
        ],
        // [
        //     'key' => 'advertise_why_not_accept_status',
        //     'value' => "این آگهی شامل اطلاعات نادرست است.+ در این آگهی اطلاعات ناکافی است.+ این آگهی مورد تایید نیست.",
        //     'description' => 'دلایل رد شدن آگهی ها',
        // ],
        [
            'key' => 'theme',
            'value' => 'default',
            'description' => 'قالب سامانه',
        ],
    ];
}