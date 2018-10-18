<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
	use SoftDeletes;
    protected $guarded = [];
    protected $hidden = [
    	'created_at',
    	'deleted_at',
    	'updated_at',
    ];
    protected $fillable = [
		'id',
		'user_id',
		'total_price',
		'user_ip',
		'tref',
		'payment',
		'error',
		'Invoice_number',
		'Invoice_date',
		'description',
		'status',
		'factor_id',
	];

    const STATUS_SUCCEED = 1;
    const STATUS_UNSUCCEED = 2;
    const STATUS_SEND_BANK = 3;
    const STATUS_CHECK = 4;

    public static $STATUS = [
        self::STATUS_UNSUCCEED => 'ناموفق',
        self::STATUS_SUCCEED => 'موفق',
        self::STATUS_SEND_BANK => 'به بانک ارسال شده است.',
        self::STATUS_CHECK => 'بررسی شده است',
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

    public function scopeMine($query)
    {
        return $query->where('user_id', \Auth::id());
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function factor()
    {
        return $this->belongsTo('App\Models\Factor');
    }


    // public function mellatRequest(){
    //     $component = new \app\components\Mellat;
    //     $component->setFactor($this);
    //     return $component->request();
    // }

    // public function pasargadRequest(){
    //     $component = new \app\components\Pasargad\Pasargad;
    //     $component->setFactor($this);
    //     return $component->request();
    // }

}
