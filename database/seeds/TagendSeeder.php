<?php

use Illuminate\Database\Seeder;
use App\Models\Tagend;
class TagendSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tagends = [
        	[
        		'title' => 'ارسال معمولی',
        		'description' => 'زمان ارسال بین ۱ الی ۲ روز است.',
        		'value' => 8000,
        		'sign' => Tagend::SIGN_POSITIVE,
        		'type' => Tagend::TYPE_ABSOLUTE,
        		'is_copon' => 0,
        		'code' => null,
        		'status' => Tagend::STATUS_ACTIVE,
        		'used_by' => null,
        		'user_id' => 1,
        	],
        	[
        		'title' => 'ارسال سفارشی',
        		'description' => 'زمان ارسال کمتر از ۱ روز است.',
        		'value' => 10000,
        		'sign' => Tagend::SIGN_POSITIVE,
        		'type' => Tagend::TYPE_ABSOLUTE,
        		'is_copon' => 0,
        		'code' => null,
        		'status' => Tagend::STATUS_ACTIVE,
        		'used_by' => null,
        		'user_id' => 1,
        	],
        	[
        		'title' => 'ارسال با پیک موتوری',
        		'description' => 'زمان ارسال تا ساعاتی دیگر',
        		'value' => 12000,
        		'sign' => Tagend::SIGN_POSITIVE,
        		'type' => Tagend::TYPE_ABSOLUTE,
        		'is_copon' => 0,
        		'code' => null,
        		'status' => Tagend::STATUS_ACTIVE,
        		'used_by' => null,
        		'user_id' => 1,
        	],
        	[
        		'title' => 'مالیات',
        		'description' => 'مالیات برابر ۲ درصد می باشد.',
        		'value' => 2,
        		'sign' => Tagend::SIGN_POSITIVE,
        		'type' => Tagend::TYPE_PERCENT,
        		'is_copon' => 0,
        		'code' => null,
        		'status' => Tagend::STATUS_DEACTIVE,
        		'used_by' => null,
        		'user_id' => 1,
        	],
        	[
        		'title' => 'ارزش افزوده',
        		'description' => 'ارزش افزوده برابر ۳ درصد می باشد.',
        		'value' => 3,
        		'sign' => Tagend::SIGN_POSITIVE,
        		'type' => Tagend::TYPE_PERCENT,
        		'is_copon' => 0,
        		'code' => null,
        		'status' => Tagend::STATUS_DEACTIVE,
        		'used_by' => null,
        		'user_id' => 1,
        	],
        	[
        		'title' => 'هزینه بسته بندی',
        		'description' => 'هزینه بسته بندی هزار تومان است.',
        		'value' => 1000,
        		'sign' => Tagend::SIGN_POSITIVE,
        		'type' => Tagend::TYPE_ABSOLUTE,
        		'is_copon' => 0,
        		'code' => null,
        		'status' => Tagend::STATUS_DEACTIVE,
        		'used_by' => null,
        		'user_id' => 1,
        	],
        ];

        foreach($tagends as $tagend){
            Tagend::updateOrCreate(['title' => $tagend['title']], $tagend);
        }
    }
}
