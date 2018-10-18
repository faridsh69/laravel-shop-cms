<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Baner extends Model
{
    protected $guarded = [];
    protected $hidden = [
    	'created_at',
    	'updated_at',
    ];

    protected $fillable = [
		'id',
		'title',
		'description',
        'link',
		'tag',
        'location',
        'status',
		'image_id',
		'user_id',
	];

	const LOCATION_RIGHT_SLIDER = 1;
    const LOCATION_LEFT_SLIDER = 2;

    public static $LOCATION = [
        self::LOCATION_RIGHT_SLIDER => 'موقعیت بنر سمت راست',
        self::LOCATION_LEFT_SLIDER => 'موقعیت بنر سمت چپ',
    ];

    public function location_translate()
    {
        if( isset(self::$LOCATION[$this->location]) ){
            return self::$LOCATION[$this->location];
        }else{
            return 'موقعیت ندارد';
        }
    }

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

    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    public function scopeMine($query)
    {
        return $query->where('user_id', \Auth::id());
    }

    public function scopeDesc($query)
    {
        return $query->orderBy('id', 'desc');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
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
}
