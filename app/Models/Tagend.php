<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tagend extends Model
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
		'value', 
		'sign',
		'type',
		'is_copon',
        'code',
        'used_count',
        'used_from',
        'used_to',
        'minimum_price',
		'status',
		'used_by',
		'user_id',
	];

    const SIGN_POSITIVE = 1;
    const SIGN_NEGATIVE = 0;

    public static $SIGNES = [
        self::SIGN_POSITIVE => '+',
        self::SIGN_NEGATIVE => '-'
    ];

    public function sign_translate()
    {
        if(isset( self::$SIGNES[$this->sign] ) ){
            return self::$SIGNES[$this->sign];
        }else{
            return '?';
        }
    }

    const TYPE_ABSOLUTE = 0;
    const TYPE_PERCENT = 1;

    public static $TYPES = [
        self::TYPE_ABSOLUTE => ' تومان',
        self::TYPE_PERCENT => '%'
    ];

    public function type_translate()
    {
        if(isset( self::$TYPES[$this->type] ) ){
            return self::$TYPES[$this->type];
        }else{
            return '?';
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
        if(isset( self::$STATUS[$this->status] ) ){
        	return self::$STATUS[$this->status];
        }else{
            return 'وضعیت ندارد';
        }
    }

    public function scopeMine($query)
    {
        return $query->where('user_id', \Auth::id());
    }

    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    public function scopeForced($query)
    {
        return $query->where('title', 'NOT LIKE', '%ارسال%')
            ->where('is_copon', 0)
            ->where('status', self::STATUS_ACTIVE);
    }

    public function scopeShipping($query)
    {
        return $query->where('title', 'like', '%ارسال%')
            ->where('is_copon', 0)
            ->where('status', self::STATUS_ACTIVE);
    }
    
    public function scopeCopon($query)
    {
        return $query->where('is_copon', 1)
            ->where('status', self::STATUS_ACTIVE);
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function used_by()
    {
        return $this->belongsTo('App\Models\User', 'used_by');
    }

    public function factors()
    {
        return $this->hasMany('App\Models\Factor');
    }

    public function generateCode()
    {
    	return random(100000,999999);
    }
}