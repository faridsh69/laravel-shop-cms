<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
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
		'name',
		'description',
		'alt',
		'type',
		'mime_type',
		'ext',
        'src',
        'src100',
		'src400',
		'size',
		'width',
		'height',
		'user_id',
	];

	const TYPE_PRODUCT = 'کالا';
    const TYPE_ADVERTISE = 'آگهی';
    const TYPE_BRAND = 'برند';
    const TYPE_ARTICLE = 'مقاله';
    const TYPE_NEWS = 'خبر';
    const TYPE_PAGE = 'صفحه';

    public static $TYPES = [
        self::TYPE_PRODUCT => 'کالا',
        self::TYPE_ADVERTISE => 'آگهی',
        self::TYPE_BRAND => 'برند',
        self::TYPE_ARTICLE => 'مقاله',
        self::TYPE_NEWS => 'خبر',
        self::TYPE_PAGE => 'صفحه',
    ];

    public function type_translate()
    {
        if( isset(self::$TYPES[$this->type]) ){
            return self::$TYPES[$this->type];
        }else{
            return 'ندارد';
        }
    }

	public static function getFillables()
    {
    	return (new self)->fillable;
    }

    public function scopeMine($query)
    {
        return $query->where('user_id', \Auth::id());
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\Product');
    }
}
