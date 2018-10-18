<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $guarded = [];
    protected $hidden = [
        'created_at',
    	'updated_at',
    ];
    protected $fillable = [
    	'id',
		'message',
		'users_list_id',
		'user_id',
	];

	const STATUS_SENDING = 1;
    const STATUS_SENT = 2;
    const STATUS_FAILED = 3;

    public static $STATUS = [
        self::STATUS_SENDING => 'در حال ارسال',
        self::STATUS_SENT => 'ارسال شد',
        self::STATUS_FAILED => 'خطا داد',
    ];

    public static function getFillables()
    {
    	return (new self)->fillable;
    }

    public function status_translate()
    {
        if( isset(self::$STATUS[$this->status]) ){
            return self::$STATUS[$this->status];
        }else{
            return 'وضعیت ندارد';
        }
    }

	public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
