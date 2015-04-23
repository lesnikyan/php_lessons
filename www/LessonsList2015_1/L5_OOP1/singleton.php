<?php

require_once '../common.php';

class SuperFramework {
	
	private static $instance = null;
	private static $id;
	private static $lastId = 1;
	
	private function __construct(){ 
		self::$id = self::$lastId++;
	}
	
	public static function inst(){
		if(self::$instance == null){
			self::$instance = new SuperFramework();
		}
		p("id = " . self::$id);
		return self::$instance;
	}
	
	function get($key){
		return isset($_GET[$key]) ? $_GET[$key] : NULL;
	}
}

$fw = SuperFramework::inst();
p($fw->get('name'));
p(SuperFramework::inst()->get('status'));

