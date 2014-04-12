<?php

class User{
	private $data = [];
	private $fields = ['id', 'name', 'login', 'age'];
	
	function __construct($data){
		foreach($fields as $field){
			if(! isset($data[$field])){
				throw Exception('Incorrect user data set');
			}
			$this->data[$field] = $data[$field];
		}
	}
	
	function __get($name){
		if(isset($this->data[$name])){
			return $this->data[$name];
		}
		return null;
	}
	
	function __set($name, $val){}
}