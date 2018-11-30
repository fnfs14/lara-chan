<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Uuid;
use DB;
use Auth;
use App\_user;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	
	protected function _uuid($table,$primary){
		$uuid = Uuid::generate();
		$query = DB::table($table)->where($primary,$uuid)->count();
		while($query >= 1) {
			$uuid = Uuid::generate();
			$query = DB::table($table)->where($primary,$uuid)->count();
		}
		return $uuid;
	}
	
	protected function _getClient(){
		$query = _user::where('role','"cfd7a2c0-f05b-11e8-8abf-dbf626e8ec69"')->get();
		return $query;
	}
	
	protected function _flashStore($query,$r){
		if(!$query){ // if failed
			$text = "Failed to add $r";
			$type = 'warning';
		}else{ // if success
			$text = "$r has been added.";
			$type = 'success';
		}
		session()->flash('text', $text);
		session()->flash('type', $type);
	}
}
