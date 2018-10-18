<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Factor extends Model
{
	use SoftDeletes;

    protected $guarded = [];
    protected $hidden = [
    	'deleted_at',
    	'updated_at',
    ];

    protected $fillable = [
		'id',
		'total_price',
		'shipping', 
		'payment', 
		'user_description',
		'admin_description',
		'status',
        'admin_seen',
		'address_id',
        'user_id',
		'admin_id',
        'created_at',
        'updated_at'
	];

    const SHIPPING_MAMOLI = 'معمولی';
    const SHIPPING_FAST = 'سریع';
    const SHIPPING_SEFARESHI = 'سفارشی';

    const PAYMENT_LOCAL = 'پرداخت در محل';
    const PAYMENT_CART = 'پرداخت کارت به کارت';
    const PAYMENT_ONLINE = 'پرداخت آنلاین';

    const STATUS_INITIAL = 1;
    const STATUS_PAYMENT = 2;
    const STATUS_PROCCESSING = 3;
    const STATUS_PREPARING = 4;
    const STATUS_DELIVERING = 5;
    const STATUS_CANCELED = 6;
    const STATUS_SUCCEED = 7;

    public static $STATUS = [
        self::STATUS_INITIAL => 'ثبت اولیه سفارش',
        self::STATUS_PAYMENT => 'انتقال به درگاه بانک',
        self::STATUS_PROCCESSING => 'درحال بررسی سفارش',
        self::STATUS_PREPARING => 'درحال آماده سازی کالاها',
        self::STATUS_DELIVERING => 'تحویل به سیستم حمل و نقل',
        self::STATUS_CANCELED => 'سفارش لغو گردید',
        self::STATUS_SUCCEED => 'سفارش تحویل داده شد',
    ];

    public static $STATUS_ADMIN = [
        self::STATUS_PROCCESSING => 'درحال بررسی سفارش',
        self::STATUS_PREPARING => 'درحال آماده سازی کالاها',
        self::STATUS_DELIVERING => 'تحویل به سیستم حمل و نقل',
        self::STATUS_CANCELED => 'سفارش لغو گردید',
        self::STATUS_SUCCEED => 'سفارش تحویل داده شد',
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

    public function scopeCurrentFactor($query)
    {
        return $query->where('user_id', \Auth::id())
            ->where('status', '<', 3)
            // ->where('admin_seen', 0)
            // ->where('created_at', '>', carbon::now()->subHour() )
            ->orderBy('id', 'desc');            
    }
    
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function address()
    {
        return $this->belongsTo('App\Models\Address');
    }

    public function payments()
    {
        return $this->hasMany('App\Models\Payment')->orderBy('id', 'desc');;
    }

    public function last_payment()
    {
        return $this->payments()->orderBy('id', 'desc')->first();
    }
    
    public function products()
    {
        return $this->belongsToMany('App\Models\Product')->withPivot('count')->withPivot('price')->withPivot('discount_price');
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

    public function total_price_products()
    {
        $factor_product = $this->products()->get();
        $total_price = 0;
        foreach($factor_product as $item)
        {
            if($item->pivot->discount_price){
                $total_price = $total_price + ( $item->pivot->count * $item->pivot->discount_price );
            }else{
                $total_price = $total_price + ( $item->pivot->count * $item->pivot->price );
            }
        }
        return $total_price;
    }

    public function tagends()
    {
        return $this->belongsToMany('App\Models\Tagend')->withPivot('value');;
    }

    public function calculateTotalPriceWithTagends()
    {
        $total_price = $this->total_price_products();

        foreach($this->tagends as $tagend)
        {
            $total_price = $total_price + $tagend->pivot->value; 
        }
        if($total_price < 0){
            $total_price = 0;
        }
        return $total_price;
    }

    public function fillFactorTagends()
    {
        $tagends = Tagend::forced()
            ->get();

        foreach ($tagends as $tagend) 
        {
            $this->addTagendToFactor($tagend);
        }

        return $this;
    }

    public function addTagendToFactor($tagend)
    {
        if($tagend->type == 0)
        { // absolute
            if( $tagend->sign == 1){
                $value = $tagend->value;
            }else{
                $value = (-1) * $tagend->value;
            }
        }else{ // percent
            if( $tagend->sign == 1){
                $value = ( $tagend->value * $this->total_price ) / 100;
            }else{
                $value = ( (-1) * $tagend->value * $this->total_price) / 100;
            }
        }
        $this->tagends()->syncWithoutDetaching([
            $tagend->id => [
                'value' => $value,
            ]
        ]);
    }

    public function fillFactorProducts()
    {
        $this->products()->sync([]);
        $basket = \App\Http\Services\FactorService::_getUserBasket();

        foreach($basket->products as $product) 
        {
            if($product->status != Product::STATUS_AVAILABLE){
                continue;
            }
            $count = $product->pivot->count;
            $this->products()->syncWithoutDetaching([
                $product->id => [
                    'count' => $count,
                    'price' =>  $product->price,
                    'discount_price' =>  $product->discount_price,
                ]
            ]);
        }

        return $this;
    }

    public function detachShippings()
    {
        $tagends = Tagend::shipping()
            ->get();

        foreach ($tagends as $tagend) 
        {
            $this->tagends()->detach([$tagend->id]);
        }

        return $this;
    }
}
