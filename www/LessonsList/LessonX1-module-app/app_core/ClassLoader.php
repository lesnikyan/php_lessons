<?php
defined('MAIN_ENTRY_POINT') || header("HTTP/1.0 404 Not Found") && die('incorrect request entry point');

class ClassLoader {
	
	public static function load($files){
		if(!is_array($files)){
			$files = [$files];
		}
		foreach($files as $file){
			if(!file_exists($file)){
				throw new Exception("No file for module: $name ");
			}
			require_once $file;
		}
	}
	
	public static function getModule($name){
		$className = Config::inst()->modules[$name];
		$file = DOC_ROOT . "/modules/" . $className . ".php";
		if(!file_exists($file)){
			throw new Exception("No file for module: $name ");
		}
		require_once $file;
		return new $className();
	}
}