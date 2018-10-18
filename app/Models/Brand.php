<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
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
		'title',
		'description',
		'meta_title',
		'meta_description',
		'status',
		'image_id',
		'user_id',
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

    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    public function scopeMine($query)
    {
        return $query->where('user_id', \Auth::id());
    }

    public function scopeDsc($query)
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
