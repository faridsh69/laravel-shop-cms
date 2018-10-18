<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $guarded = [];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'id',
        'type',
        'user_ip',
        'product_id',
        'user_id',
    ];

    const TYPE_DISLIKE = 0;
    const TYPE_LIKE = 1;

    public static function getFillables()
    {
        return (new self)->fillable;
    }

    public function scopeMine($query)
    {
        return $query->where('user_id', \Auth::id());
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public static $TYPES = [
        self::TYPE_DISLIKE => 'دیس لایک',
        self::TYPE_LIKE => 'لایک',
    ];

    public function type_translate()
    {
        if( isset(self::$TYPES[$this->type]) ){
            return self::$TYPES[$this->type];
        }else{
            return 'وضعیت ندارد';
        }
    }

    public function scopeLike($query)
    {
        return $query->where('type', self::TYPE_LIKE);
    }

    public function scopeDislike($query)
    {
        return $query->where('type', self::TYPE_DISLIKE);
    }
}



