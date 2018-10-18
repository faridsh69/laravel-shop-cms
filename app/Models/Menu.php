<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $hidden = [
    	'created_at',
    	'updated_at',
    	'deleted_at',
    ];

    protected $fillable = [
		'id',
		'title',
		'url',
        'order',
        'location',
		'status',
		'menu_item_id',
		'user_id',
	];

    const LOCATION_HEADER = 1;
    const LOCATION_FOOTER = 2;

    public static $LOCATION = [
        self::LOCATION_HEADER => 'موقعیت بالای سایت بخش هدر',
        self::LOCATION_FOOTER => 'موقعیت زیر سایت بخش فوتر',
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

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function menu()
    {
        return $this->belongsTo('App\Models\Menu');
    }

    public function menus()
    {
        return $this->hasMany('App\Models\Menu');
    }
}
