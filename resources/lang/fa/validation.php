<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'The :attribute must be accepted.',
    'active_url'           => 'The :attribute is not a valid URL.',
    'after'                => 'The :attribute must be a date after :date.',
    'alpha'                => 'The :attribute may only contain letters.',
    'alpha_dash'           => 'The :attribute may only contain letters, numbers, and dashes.',
    'alpha_num'            => 'The :attribute may only contain letters and numbers.',
    'array'                => 'The :attribute must be an array.',
    'before'               => 'The :attribute must be a date before :date.',
    'between'              => [
        'numeric' => 'مقدار :attribute باید بین :min و :max. باشد',
        'file' => 'حجم فایل :attribute  باید کمتر از :max kilobytes باشد.',
        'string'  => 'The :attribute must be between :min and :max characters.',
        'array'   => 'The :attribute must have between :min and :max items.',
    ],
    'boolean'              => 'The :attribute field must be true or false.',
    'confirmed'            => ' :attribute با تکرارآن یکسان نمی‌باشد.',
    'date'                 => 'The :attribute is not a valid date.',
    'date_format'          => 'The :attribute does not match the format :format.',
    'different'            => 'The :attribute and :other must be different.',
    'digits'               => ' :attribute باید :digits رقم باشد.',
    'digits_between'       => 'The :attribute must be between :min and :max digits.',
    'dimensions'           => 'The :attribute has invalid image dimensions.',
    'distinct'             => 'The :attribute field has a duplicate value.',
    'email'                => ' :attribute وارد شده معتبر نمی‌باشد.',
    'exists' => ' :attribute وارد شده در سیستم ثبت نشده‌است.',
    'file'                 => 'The :attribute must be a file.',
    'filled'               => 'The :attribute field is required.',
    'image' => ' :attribute باید فایل تصویری باشد.',
    'in'                   => 'The selected :attribute is invalid.',
    'in_array'             => 'The :attribute field does not exist in :other.',
    'integer'              => 'The :attribute must be an integer.',
    'ip'                   => 'The :attribute must be a valid IP address.',
    'json'                 => 'The :attribute must be a valid JSON string.',
    'max'                  => [
        'numeric' => ' :attribute باید کوچکتر از :max باشد.',
        'file' => ' :attribute باید کوچکتر از :max کیلوبایت باشد.',
        'string' => ' :attribute باید کوچکتر از :max کاراکتر باشد.',
        'array'   => 'The :attribute may not have more than :max items.',
    ],
    'mimes' => 'پسوند :attribute باید از نوع: :values باشد.',
    'mimetypes'            => 'The :attribute must be a file of type: :values.',
    'min'                  => [
        'numeric' => ':attribute باید حداقل :min تومان باشد.',
        'file'    => 'The :attribute must be at least :min kilobytes.',
        'string' => ' :attribute باید حداقل :min کاراکتر باشد.',
        'array'   => 'The :attribute must have at least :min items.',
    ],
    'not_in'               => 'The selected :attribute is invalid.',
    'numeric'              => ' :attribute باید عدد باشد.',
    'present'              => 'The :attribute field must be present.',
    'regex'                => 'The :attribute format is invalid.',
    'national_security_number'             => ' :attribute وارد شده معتبر نمی‌باشد.',
    'required'             => 'فیلد :attribute اجباری می‌باشد.',
    'required_if'          => 'The :attribute field is required when :other is :value.',
    'required_unless'      => 'The :attribute field is required unless :other is in :values.',
    'required_with'        => 'The :attribute field is required when :values is present.',
    'required_with_all'    => 'The :attribute field is required when :values is present.',
    'required_without'     => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same'                 => 'The :attribute and :other must match.',
    'size'                 => [
        'numeric' => 'The :attribute must be :size.',
        'file'    => 'The :attribute must be :size kilobytes.',
        'string'  => 'The :attribute must be :size characters.',
        'array'   => 'The :attribute must contain :size items.',
    ],
    'string'               => 'The :attribute must be a string.',
    'timezone'             => 'The :attribute must be a valid zone.',
    'unique'               => ' :attribute موردنظر قبلا ثبت شده است.',
    'uploaded'             => 'The :attribute failed to upload.',
    'url'                  => 'The :attribute format is invalid.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'first_name' => 'نام',
        'last_name' => 'نام خانوادگی',
        'name' => 'نام',
        'display_name' => 'نام و نام خانوادگی',
        'username' => 'نام‌ کاربری',
        'phone' => 'شماره همراه',
        'sabet_phone' => 'شماره ثابت',
        'city' => 'شهر',
        'province' => 'استان',
        'country_id' => 'کشور',
        'lable' => 'برچسب',
        'off' => 'میزان تخفیف',
        'address' => 'آدرس',
        'password' => 'رمزعبور',
        'email' => 'ایمیل',
        'national_security_number' => 'کدملی',
        'gender' => 'جنسیت',
        'title' => 'عنوان',
        'product_type' => 'نوع',
        'agreement' => 'تاییدیه',
        'message' => 'پیام',
        'food_image' => 'تصویر غذا',
        'restaurant_image' => 'تصویر رستوران',
        'newpassword' => 'رمزعبور جدید',
        'oldpassword' => 'رمزعبور قدیم',
        'who' => 'گیرنده',
        'sms' => 'متن اس ام اس',
        'price' => 'قیمت',
        'charge-credit' => 'مبلغ شارژ',
        'mojodi' => 'موجودی',
        'type_id' => 'دسته بندی',
        'sabet' => 'شماره ثابت',
        'postcode' => 'کد پستی',   
        'postal_code' => 'کد پستی',   
        'user_id' => 'کاربر',   
        'meta_title' => 'عنوان در موتورهای جستجو',   
        'meta_description' => 'توضییحات موتور جستجو',
        'description' => 'توضیحات',   
        'noe_ghete' => 'نوع قطعه',
        'operator' => 'اپراتور',
        'sim_cart_type' => 'نوع سیم کارت',
        'sim_cart_number' => 'شماره سیم کارت',
        'aggrement' => 'توافق نامه',
        'value' => 'مقدار',
        'inventory' => 'موجودی',
        'discount_price' => 'قیمت تخفیف خورده',
    ],
];