<?php

define ('BASE_PATH', __DIR__);

$dbconf = (object)[
	'host' => 'localhost',
	'login' => 'dev2',
	'pass' => '1',
	'dbname' => 'lesson7',
	'port' => ''
];

session_start();

include '../common.php';

include 'user.php';
include 'db.php';

if(0){
class Cont{
	private $controller;
	function __construct($url){
		$this->init($val);
	}

	function init($url){
		// controller, method, params -> 
	}
	
	function __set($name, $val){
		if($name == 'url')
			return $this->init($val);
	}
	
	function __get($name){
		if(strlen($name) < 3)
			return null;
		if($name == 'controller'){ return $this->controller;} // SELECT controller FROM controllers..
			
	}
}

$cont = new Cont('domain.com/aaa/sss/ddd');
$cont->url = 'domain.com/aaa/ttt/123'; 

$controller = $cont->controller;

}
