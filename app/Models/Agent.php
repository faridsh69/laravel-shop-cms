<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agent extends Model
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
		'address_id',
		'brand_id',
		'image_id',
		'user_id',
		'description',
		'status',
	];

    const STATUS_ACTIVE = 1;
    const STATUS_DEACTIVE = 2;

    public static $STATUS = [
        self::STATUS_ACTIVE => 'فعال',
        self::STATUS_DEACTIVE => 'غیر فعال',
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
    	
	public function brand()
    {
        return $this->belongsTo('App\Models\Brand');
    }

    public function brand_title()
    {
        return $this->brand ? $this->brand->title : '-';
    }

    public function image()
    {
        return $this->belongsTo('App\Models\Image');
    }

    public function base_image()
    {
        if( $this->image )
        {
            return $this->image->src;
        }else{
            return \App\Http\Services\SettingService::setting()['default_image'];
        }   
    }

    public function base_image_100()
    {
        if( $this->image )
        {
            return $this->image->src100;
        }else{
            return \App\Http\Services\SettingService::setting()['default_image'];
        }    
    }

    public function address()
    {
        return $this->belongsTo('App\Models\Address');
    }
}
