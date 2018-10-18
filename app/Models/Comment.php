<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	protected $guarded = [];
    protected $hidden = [
    	'created_at',
    	'updated_at',
    ];

    protected $fillable = [
		'id',
		'comment',
		'admin_seen',
		'status',
		'product_id',
		'user_id',
		'comment_id',
	];

	public static function getFillables()
    {
    	return (new self)->fillable;
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function comment()
    {
        return $this->belongsTo('App\Models\Comment');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    const STATUS_ACTIVE = 1;
    const STATUS_DEACTIVE = 2;

    public static $STATUS = [
        self::STATUS_ACTIVE => 'تایید',
        self::STATUS_DEACTIVE => 'عدم تایید',
    ];

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
}
