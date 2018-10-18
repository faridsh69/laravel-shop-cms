<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Advertise extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $hidden = [
    	'deleted_at',
    	'updated_at',
    ];

    protected $fillable = [
		'id',
		'title',
		'description',
		'phone',
		'address',
		'price_type',
		'price',
		'noe_ghete', // for specific type
		'operator', // for specific type
		'sim_cart_type', // for specific type
		'sim_cart_number', // for specific type
		'aggrement',
		'status',
        'admin_seen',
		'image_id',
		'brand_id',
		'category_id',
		'user_id',
        'why_not_accept_status',
        'why_not_accept_text',
        'group_id',
        
        'views_count'
	];

    protected $fillable_array = [
        'price_type',
        'price',
        'noe_ghete',
        'operator',
        'sim_cart_type', 
        'sim_cart_number',
        'brand_id',
    ];

    public static function getFillableArrays()
    {
        return (new self)->fillable_array;
    }


    const SIM_CART_TYPE_ROND = 1;
    const SIM_CART_TYPE_NORMAL = 2;

    public static $SIM_CART_TYPES = [
        self::SIM_CART_TYPE_ROND => 'رند',
        self::SIM_CART_TYPE_NORMAL => 'عادی'
    ];

    public function sim_cart_type_translate()
    {
        if(isset( self::$SIM_CART_TYPES[$this->sim_cart_type] ) ){
            return self::$SIM_CART_TYPES[$this->sim_cart_type];
        }else{
            return '-';
        }
    }

    const OPERATOR_TYPE_HAMRAH_AVVAL = 1;
    const OPERATOR_TYPE_IRANCELL = 2;
    const OPERATOR_TYPE_RIGHTEL = 3;
    const OPERATOR_TYPE_TALIA = 4;

    public static $OPERATOR_TYPES = [
        self::OPERATOR_TYPE_HAMRAH_AVVAL => 'همراه اول',
        self::OPERATOR_TYPE_IRANCELL => 'ایرانسل',
        self::OPERATOR_TYPE_RIGHTEL => 'رایتل',
        self::OPERATOR_TYPE_TALIA => 'تالیا'
    ];

    public function operator_type_translate()
    {
        if(isset( self::$OPERATOR_TYPES[$this->operator] ) ){
            return self::$OPERATOR_TYPES[$this->operator];
        }else{
            return '-';
        }
    }

    const STATUS_ACTIVE = 1;
    const STATUS_DEACTIVE = 2;
    const STATUS_EXPIRED = 3;

    public static $STATUS = [
        self::STATUS_ACTIVE => 'فعال',
        self::STATUS_DEACTIVE => 'غیر فعال',
        self::STATUS_EXPIRED => 'منقضی شده است',
    ];

    public function status_translate()
    {
        if(isset( self::$STATUS[$this->status] ) ){
            return self::$STATUS[$this->status];
        }else{
            return '-';
        }
    }

    const PRICE_TYPE_MAGHTO = 1;
    const PRICE_TYPE_TAVAFOGHI = 2;
    const PRICE_TYPE_AGHSATI = 3;

    public static $PRICE_TYPES = [
        self::PRICE_TYPE_MAGHTO => 'مقطوع',
        self::PRICE_TYPE_TAVAFOGHI => 'توافقی',
        self::PRICE_TYPE_AGHSATI => 'اقساطی'
    ];

    public function price_type_translate()
    {
        if(isset( self::$PRICE_TYPES[$this->price_type] ) ){
            return self::$PRICE_TYPES[$this->price_type];
        }else{
            return '-';
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

    public static function getFillables()
    {
        return (new self)->fillable;
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function brand()
    {
        return $this->belongsTo('App\Models\Brand');
    }

    public function brand_title()
    {
        return $this->brand ? $this->brand->title : '-';
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function images()
    {
        return $this->belongsToMany('App\Models\Image');
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

    public function views()
    {
        return $this->hasMany('App\Models\AdvertiseView');
    }

    public function gallery_image($key)
    {
        $images = $this->images()->get();
        if( $images && $images[$key])
        {
            return $images[$key]->src;
        }else{
            return \App\Http\Services\SettingService::setting()['default_image'];
        }  
    }

    public function gallery_image100($key)
    {
        $images = $this->images()->get();
        if( $images && $images[$key])
        {
            return $images[$key]->src100;
        }else{
            return \App\Http\Services\SettingService::setting()['default_image'];
        }  
    }
    public function gallery_first_image()
    {
        $images = $this->images()->first();
        if( $images && $images)
        {
            return $images->src100;
        }else{
            return \App\Http\Services\SettingService::setting()['default_image'];
        }
    }
}
