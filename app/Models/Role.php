<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class role extends Model
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
		'name',
        'description',
		'permissions',
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
    
    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }
}
