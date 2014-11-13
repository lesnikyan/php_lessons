<?php
defined('MAIN_ENTRY_POINT') || header("HTTP/1.0 404 Not Found") && die('incorrect request entry point');


class Config {
	private $conf;
	private static $_inst = null;
	
	function __construct($data){
		$this->conf = $data;
	}
	
	// create instance and set values
	public static function init($data){
		self::$_inst = new self($data);
	}
	
	// get instance of class
	public static function inst(){
		if(!$_inst){
			throw new Exception("uninitialized config");
		}
		return selt::$_inst;
	}
	
	// get value from config
	public function getVal($key){
		if(!isset($this->data[$key]))
			return null;
		return $this->data[$key];
	}
	
	public function __get($key){
		return $this->get($key);
	}
	
	// get value statically
	public static function get($key){
		return self::inst()->get($key);
	}
}
