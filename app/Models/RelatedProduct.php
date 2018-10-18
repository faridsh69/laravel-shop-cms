<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RelatedProduct extends Model
{
    protected $guarded = [];
    protected $hidden = [
    	'created_at',
    	'deleted_at',
    	'updated_at',
    ];
    protected $fillable = [
		'id',
		'product_id',
        'related_product_id',
	];

	public static function getFillables()
    {
    	return (new self)->fillable;
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function related_product()
    {
        return $this->belongsTo('App\Models\Product', 'related_product_id');
    }
}
