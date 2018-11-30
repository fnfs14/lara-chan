<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class _task extends Model
{
	// use SoftDeletes;
    protected $table = 'public.users';
	protected $primaryKey = 'id';
    protected $guarded = [];
	public $incrementing = false;
	// protected $dates = ['deleted_at'];

    // public function submenu()
    // {
    	// return $this->belongsTo(_Menu::class, 'parent');
		// return $this->hasMany(_Menu::class, 'parent', 'id');
    // }
}
