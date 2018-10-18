<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Forum extends Model
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
		'content',
		'status',
        'admin_seen',
		'forum_id',
		'category_id',
		'user_id',

        'views_count'
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

    public function forum()
    {
        return $this->belongsTo('App\Models\Forum');
    }

    public function forums()
    {
        return $this->hasMany('App\Models\Forum');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function views()
    {
        return $this->hasMany('App\Models\ForumView');
    }

    public function views_count_all()
    {
        return $this->views->count();
    }

    public function answers_count()
    {
        return $this->forums->count();
    }

    public function scopeCheckUserRole($query, $role_id)
    {
        if($role_id)
        {
            $role = \App\Models\Role::find($role_id);
            if($role){
                $role_name = $role->name;
                return $query->whereHas('user.roles', function($user_query) use ($role_name){
                        $user_query->where('name', $role_name);
                    });
            }else{
                return $query;
            }
        }else{
            return $query;
        }
    }
}
