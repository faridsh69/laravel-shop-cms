<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
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
		'type',
		'description',
		'meta_title',
		'meta_description',
        'order',
        'filter',
		'status',
		'category_id',
		'user_id',
        'image_id',
	];

    const TYPE_PRODUCT = 'محصول';
    const TYPE_ARTICLE = 'مقاله';
    const TYPE_NEWS = 'خبر';
    const TYPE_PAGE = 'صفحه';
    const TYPE_FORUM = 'انجمن';
    const TYPE_ADVERTISE = 'آگهی';
	const TYPE = ['محصول', 'آگهی', 'انجمن', 'مقاله', 'خبر', 'صفحه'];
	
    const STATUS_ACTIVE = 1;
    const STATUS_DEACTIVE = 2;

    public static $STATUS = [
        self::STATUS_ACTIVE => 'فعال',
        self::STATUS_DEACTIVE => 'غیر فعال',
    ];

    public static $TYPES = [
        0 => self::TYPE_PRODUCT,
        1 => self::TYPE_ADVERTISE,
        2 => self::TYPE_FORUM,
        3 => self::TYPE_ARTICLE,
        4 => self::TYPE_NEWS,
        5 => self::TYPE_PAGE,
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

    public function scopeProduct($query)
    {
        return $query->where('type', self::TYPE_PRODUCT );
    }

    public function scopeAdvertise($query)
    {
        return $query->where('type', self::TYPE_ADVERTISE );
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function categories()
    {
        return $this->hasMany('App\Models\Category');
    }

    public function image()
    {
        return $this->belongsTo('App\Models\Image');
    }
}
