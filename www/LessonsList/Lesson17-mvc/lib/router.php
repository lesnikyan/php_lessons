<?php

class Router {

	private $segments = array();
	private $controller;
	private $method;
	private $params = array();
	private $path;

	function __construct(){
		$this->controller = Core::conf('default_controller');
		$this->method = Core::conf('default_method');
	}

	function load(){
		//p($_SERVER);
		$path = $_SERVER['REQUEST_URI'];
		$this->path = $path;
		$base = Core::conf('base_path');
		//p($path);
		if(strlen($path)
			&& strpos($path, $base) !== false
			&& substr($path, 0, strlen($base)) === $base ){
			$path = substr($path, strlen($base));
			$path = trim($path, '/');
			//p('path = ' . $path);
		}
		if(strlen($path) < 1)
			return $this->context();
		$seg = explode('/', $path);
		//p($seg);
		$segNum = count($seg);
		$this->segments = $seg;
		if($segNum > 0){
			$this->controller = $seg[0];
			if($segNum > 1){
				$this->method = $seg[1];
				if($segNum > 2){
					$this->params = array_slice($seg, 2);
				}
			}
		}
		return $this->context();
	}

	function context(){
		return (object) array(
			'controller' => $this->controller,
			'method' => $this->method,
			'params' => $this->params,
			'path' => $this->path
		);
	}
}