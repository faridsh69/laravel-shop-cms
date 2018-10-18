<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $hidden = [
    	'created_at',
    	'deleted_at',
    	'updated_at',
    ];
    protected $fillable = [
		'key',
		'value',
		'description',
	];

    const SETTINGS = [
        'name',
        'phone',
        'mobile',
        'telegram',
        'instagram',
        'address',
        'description',
        'email',
        'page_size',
        'merchant_code',
        'sms_user',
        'sms_pass',
        'sms_phone',
        'google_analytics',
        'fax',
        'terminal_code',
        'zarin_pal',
        'logo',
        'favicon',
        'enamad',
        'crisp',
        'latitude',
        'longitude',
    ];
   
	public static function getFillables()
    {
    	return (new self)->fillable;
    }
}
