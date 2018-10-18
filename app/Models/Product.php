<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
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
		'price',
		'inventory',
        'discount_price',
        'bon',
		'bon_used',
		'description',
		'meta_title',
		'meta_description',
		'keywords',
		'status',
		'brand_id',
		'category_id',
		'user_id',
        'minimum_inventory',
        'group_id',
        
        'views_count'
	];

    protected $fillable_array = [
        'price',
        'discount_price',
        'inventory',
        'status', 
    ];

    public static function getFillableArrays()
    {
        return (new self)->fillable_array;
    }

    const STATUS_AVAILABLE = 1;
    const STATUS_UNAVAILABLE = 2;
    const STATUS_SOON = 3;
    const STATUS_STOP_PRODUCTION = 4;
    const STATUS_STOP_IMPORT = 5;

    public static $STATUS = [
        self::STATUS_AVAILABLE => 'موجود',
        self::STATUS_UNAVAILABLE => 'ناموجود',
        self::STATUS_SOON => 'به زودی',
        self::STATUS_STOP_PRODUCTION => 'توقف تولید',
        self::STATUS_STOP_IMPORT => 'توقف واردات',
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
        return $query->where('status', self::STATUS_AVAILABLE);
    }

    public function scopeMojod($query)
    {
        return $query->where('status', self::STATUS_AVAILABLE)
            ->where('inventory', '>', 0);
    }

    public function scopeMine($query)
    {
        return $query->where('user_id', \Auth::id());
    }

    public function scopeDesc($query)
    {
        return $query->orderBy('id', 'desc');
    }

    public function scopeDiscounted($query)
    {
        return $query->whereNotNull('discount_price');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function brand()
    {
        return $this->belongsTo('App\Models\Brand');
    }

    public function images()
    {
        return $this->belongsToMany('App\Models\Image');
    }

    public function base_image()
    {
        if( $this->images()->first() )
        {
            return $this->images()->first()->src;
        }else{
            return \App\Http\Services\SettingService::setting()['default_image_product'];
        }   
    }

    public function base_image_100()
    {
        if( $this->images()->first() )
        {
            return $this->images()->first()->src100;
        }else{
            return \App\Http\Services\SettingService::setting()['default_image_product'];
        }   
    }

    public function view_category()
    {
        if($this->category())
        {
            return $this->category()->title;
        }
        else{
            return null;
        }   
    }

    // public function bread_crumb()
    // {
    //     if($this->category)
    //     {
    //         return 'محصولات / ' . $this->category->title . ' / ' . $this->title;
    //     }
    //     else{
    //         return 'محصولات / ' . $this->title;
    //     }   
    // }

    public function features()
    {
        return $this->belongsToMany('App\Models\Feature')->withPivot('data');
    }

    public function features_price_affected()
    {
        $features = $this->features;
        return $features->where('price_affected', 1);
    }

    public function features_price_no()
    {
        $features = $this->features;
        return $features->where('price_affected', 0);
    }

    public function features_basket()
    {
        $features_basket = [];
        $i = 0;
        foreach($this->features as $feature)
        {
            $i ++;
            $features_basket[] = [
                'title' => $feature->title, 
                'data' => $feature->pivot->data
            ]; 
            if($i == 3){
                break;
            }
        }

        return $features_basket;
    }

    public function views()
    {
        return $this->hasMany('App\Models\ProductView');
    }

    public function likes()
    {
        return $this->hasMany('App\Models\ProductLike');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\ProductComment');
    }

    public function is_sell(){
        return $this->status === self::STATUS_AVAILABLE && $this->inventory !== 0;
    }

    public function is_discounted()
    {
        return $this->discountPrice ? true : false;
    }

    public function real_price()
    {
        if($this->is_discounted() ){
            return $this->discount_price;
        }else{
            return $this->price;
        }
    }

    public function gallery_image($key)
    {
        $images = $this->images()->get();
        if( $images && $images[$key])
        {
            return $images[$key]->src;
        }else{
            return \App\Http\Services\SettingService::setting()['default_image_product'];
        }  
    }

    public function gallery_image100($key)
    {
        $images = $this->images()->get();
        if( $images && $images[$key])
        {
            return $images[$key]->src100;
        }else{
            return \App\Http\Services\SettingService::setting()['default_image_product'];
        }  
    }

    public function gallery_image400($key)
    {
        $images = $this->images()->get();
        if( $images && $images[$key])
        {
            return $images[$key]->src400;
        }else{
            return \App\Http\Services\SettingService::setting()['default_image_product'];
        }  
    }

    public function related_products()
    {
        return $this->hasMany('App\Models\RelatedProduct');
    }

    public function related_product_items()
    {
        $products = [];
        foreach ($this->related_products as $related_product) {
            $products[] = \App\Models\Product::where('id', $related_product->related_product_id)
                ->first();
        }
        return collect($products);
    }
}
