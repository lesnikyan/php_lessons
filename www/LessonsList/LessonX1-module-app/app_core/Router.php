<?php
defined('MAIN_ENTRY_POINT') || header("HTTP/1.0 404 Not Found") && die('incorrect request entry point');

// url template:
// domain.com/index.php?module=mod_name|mod_method
class Router {
	public static function run(){
		$module = cu::get('module');
	}
}

class CommonUtils {
	public static function get($key){
		
		return self::assocVal($_GET, $key);
	}
	public static function post(){
		return self::assocVal($_POST, $key);
	}
	public static function sess($key, $value = null){
		if($value === null) {
			return self::assocVal($_SESSION, $key);
		}
		$_SESSION[$key] = $value;
	}
	public static function inSess($key){
		return isset($_SESSION[$key]);
	}
	public static function cookie($key, $value=null, $expire=null){
		if($value !== null){
			return setcookie($key, $value, $expire);
		}
		return self::assocVal($_COOKIE, $key);
	}
	public static function assocVal($array, $key){
		return isset($array[$key]) ? $array[$key] : null;
	}
}

class cu extends CommonUtils {}