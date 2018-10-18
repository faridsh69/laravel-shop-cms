<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use Notifiable;
    use SoftDeletes;
    
    protected $guarded = [];
    protected $hidden = [
        'password', 
        'remember_token',
        'created_at',
    	'deleted_at',
        'insertnewaddress',
    	'updated_at',
    ];
    protected $fillable = [
    	'id',
		'first_name',
		'last_name',
		'phone',
		'password',
		'email',
		'national_code',
		'gender',
		'birthday',
		'used_marketer_code',
		'generated_marketer_code',
		'rate',
		'credit',
		'status',
		'image_id',
	];

    const DEFAULT_IMAGE_URL = '/upload/images/default.png';

    const STATUS_ACTIVE = 1;
    const STATUS_DEACTIVE = 2;
    const STATUS_EXPIRED = 3;
    const STATUS_BLOCKED = 4;

    public static $STATUS = [
        self::STATUS_ACTIVE => 'فعال',
        self::STATUS_DEACTIVE => 'غیر فعال',
        self::STATUS_EXPIRED => 'منقضی',
        self::STATUS_BLOCKED => 'بلاک',
    ];

    public static function getFillables()
    {
    	return (new self)->fillable;
    }

    public static function getRepresentations(){
        $user = User::whereHas('roles', function($query){
            return $query->where('role_id',1);
        });

        return $user;    }

    public function status_translate()
    {
        if( isset(self::$STATUS[$this->status]) ){
            return self::$STATUS[$this->status];
        }else{
            return 'وضعیت ندارد';
        }
    }

    public function name()
    {
        return $this->first_name . ' ' . $this->last_name ;
    }

    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    public function scopeMine($query)
    {
        return $query->where('id', \Auth::id());
    }

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role');
    }

    public function user_logins()
    {
        return $this->hasMany('App\Models\UserLogin');
    }

    public function addresses()
    {
        return $this->hasMany('App\Models\Address');
    }

    public function author()
    {
        return $this->hasMany('App\Models\Image');
    }

    public function advertises()
    {
        return $this->hasMany('App\Models\Advertise');
    }

    public function forums()
    {
        return $this->hasMany('App\Models\Forum');
    }

    public function factores()
    {
        return $this->hasMany('App\Models\Factor');
    }

    public function avatar()
    {
        return $this->belongsTo('App\Models\Image', 'image_id');
    }

    public function scopeCheckUserRole($query, $role_id)
    {
        if($role_id)
        {
            $role = \App\Models\Role::find($role_id);
            if($role){
                $role_name = $role->name;
                return $query->whereHas('roles', function($user_query) use ($role_name){
                        $user_query->where('name', $role_name);
                    });
            }else{
                return $query;
            }
        }else{
            return $query;
        }
    }

    public function scopeRepresentations(){
        $user = User::whereHas('roles', function($query){
            return $query->where('role_id',1);
        })->get();

        return $user;
    }

    public function base_image()
    {
        if( $this->avatar )
        {
            return $this->avatar->src;
        }else{
            return \App\Http\Services\SettingService::setting()['default_image_user'];
        }   
    }

    public function base_image_100()
    {
        if( $this->avatar )
        {
            return $this->avatar->src100;
        }else{
            return \App\Http\Services\SettingService::setting()['default_image_user'];
        }    
    }

    public function images()
    {
        return $this->belongsToMany('App\Models\Image');
    }

    public function shop_image()
    {
        if($this->images->where('description', 'shop')->first())
        {
            return $this->images->where('description', 'shop')->last()->src;
        }            
        else{
            return null;
        }
    }

    public function visit_image()
    {
        if($this->images->where('description', 'visit')->first())
        {
            return $this->images->where('description', 'visit')->last()->src;
        }            
        else{
            return null;
        }
    }

    public function javaz_image()
    {
        if($this->images->where('description', 'javaz')->first())
        {
            return $this->images->where('description', 'javaz')->last()->src;
        }            
        else{
            return null;
        }
    }

    public function brands()
    {
        return $this->belongsToMany('App\Models\Brand');
    }
}
