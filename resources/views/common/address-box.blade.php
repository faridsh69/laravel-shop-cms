<div class="one-third-seperate"></div>
{{ $address->display_name ? 'نام : ' . $address->display_name : ''}} - 
{{ $address->phone ? 'شماره همراه: ' . $address->phone : ''}} -
{{ $address->sabet_phone ? 'شماره ثابت: ' . $address->sabet_phone : ''}}
<div class="one-third-seperate"></div>
{{ $address->province ? ' استان: ' . 
\Config::get('constants.provinces')[$address->province] : ''}}
- 
{{ $address->city ? ' شهر: ' . $address->city : ''}}
{{ $address->postal_code ? 'کدپستی‌: ' . $address->postal_code : ''}}
<div class="one-third-seperate"></div>
{{ $address->address ? 'آدرس: '.$address->address : ''}}
<hr>