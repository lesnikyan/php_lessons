<?php

function p($x){print "<div>$x</div>";}

function pr($x){
	print "<pre>\n"; print_r($x); print "</pre>\n";
}

class User {
	public $id;
	static $lastId = 1;
	
	function __construct(){
		$this->id = self::lastId();
		
	}
	
	static function lastId(){
		return self::$lastId++;
	}
}

$users = [];

for($i=0; $i<10; ++$i){
	$users[] = new User();
}

//pr($users);

class SF { 
	//	SuperFramework
	private static $instance = null;
	private $id;
	private static $counter = 1;
	
	function __construct(){
		$this->id = self::$counter++;
	}
	
	static function instance(){
		if(self::$instance == null){
			self::$instance = new SF();
		}
		return self::$instance;
	}
}

$sf = SF::instance();
pr($sf);

$sf = SF::instance();
pr($sf);

