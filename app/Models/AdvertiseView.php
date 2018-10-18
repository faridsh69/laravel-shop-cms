<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdvertiseView extends Model
{
    protected $guarded = [];
    protected $hidden = [
    	'created_at',
    	'deleted_at',
    	'updated_at',
    ];

    protected $fillable = [
		'id',
		'user_ip',
		'advertise_id',
		'user_id',
	];

	public static function getFillables()
    {
    	return (new self)->fillable;
    }

    public function scopeMine($query)
    {
        return $query->where('user_id', \Auth::id());
    }
    
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function advertise()
    {
        return $this->belongsTo('App\Models\Advertise');
    }
}
