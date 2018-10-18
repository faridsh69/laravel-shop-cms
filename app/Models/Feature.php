<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feature extends Model
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
		'group',
		'unit',
        'order',
        'filter',
        'type',
        'options',
        'price_affected',
		'status',
		'category_id',
		'user_id',
	];

    const TYPE_BOOLEAN = 'بله-خیر';
    const TYPE_STRING = 'متن';
    const TYPE_NUMBER = 'عدد';
    const TYPE_SELECT = 'انتخابی';
    const TYPE_MULTISELECT = 'چندمقداری';

    const STATUS_ACTIVE = 1;
    const STATUS_DEACTIVE = 2;

    public static $STATUS = [
        self::STATUS_ACTIVE => 'فعال',
        self::STATUS_DEACTIVE => 'غیر فعال',
    ];

    public static $TYPES = [
        1 => self::TYPE_STRING,
        2 => self::TYPE_NUMBER,
        0 => self::TYPE_BOOLEAN,
        3 => self::TYPE_SELECT,
        // 4 => self::TYPE_MULTISELECT,
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

    public function scopePriceAffected($query)
    {
        return $query->where('status', self::STATUS_ACTIVE)->where('price_affected', 1);
    }

    public function scopePriceNo($query)
    {
        return $query->where('status', self::STATUS_ACTIVE)->where('price_affected', 0);
    }

    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    public function scopeMine($query)
    {
        return $query->where('user_id', \Auth::id());
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
}
