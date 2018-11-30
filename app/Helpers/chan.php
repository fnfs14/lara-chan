<?php
namespace App\Helpers;
 
use Illuminate\Support\Facades\DB;
use Auth;
 
class Chan {
    
	public static function vendor($file){
		$url = asset("gentelella/vendors/" . $file);
		return $url;
	}
	
	public static function build($file){
		$url = asset("gentelella/build/" . $file);
		return $url;
	}
	
	public static function production($file){
		$url = asset("gentelella/production/" . $file);
		return $url;
	}
	
	public static function favicon($file){
		$url = asset("favicon/" . $file);
		return $url;
	}
	
	public static function css($file){
		$url = asset("css/" . $file);
		return $url;
	}
	
	public static function js($file){
		$url = asset("js/" . $file);
		return $url;
	}
	
	public static function img($file){
		$url = asset("img/" . $file);
		return $url;
	}
	
	public static function sidebar(){
		if(Auth::user()->role=="be604a60-f05b-11e8-a592-1bcc725ac046"){
			$a = 'sidebar-admin';
		}else if(Auth::user()->role=="cfd7a2c0-f05b-11e8-8abf-dbf626e8ec69"){
			$a = 'sidebar-client';
		}
		return $a;
	}
	
	public static function role(){
		$route = "/";
		if(Auth::user()->role=="be604a60-f05b-11e8-a592-1bcc725ac046"){
			$route = 'dashboard';
		}else if(Auth::user()->role=="cfd7a2c0-f05b-11e8-8abf-dbf626e8ec69"){
			$route = 'home';
		}
		return $route;
	}
	
	public static function progress($value){
		$result = '';
		if($value==100){
			$result = 'success';
		}else if($value>=75){
			$result = 'primary';
		}else if($value>=40){
			$result = 'warning';
		}else if($value>=0){
			$result = 'danger';
		}
		return $result;
	}
	
	public static function split($data,$delimiter){
		$result = explode($delimiter,$data);
		return $result;
	}
	
}