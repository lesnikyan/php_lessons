<?php

require_once '../common.php';

class User {
	private $name;
	private $age;
	private $role;
	var $someField = "QWERTY";
	
	private $data = [];
	private $publicAccessible = ['age', 'role'];
	
	function __construct($name, $age, $role="guest"){
		$this->name = $name;
		$this->age = $age;
		$this->role = $role;
		p("User: constructor");
	}
	
	function getName(){
		return $this->name;
	}
	
	function __get($name){
		p("__get: $name");
		if(in_array($name, $this->publicAccessible)){
			return $this->{$name};
		}
		if($name == 'name'){
			return $this->getName();
		}
		if(isset($this->data[$name])){
			return $this->data[$name];
		}
		return NULL;
	}
	
	function __set($name, $val){
		p("__set: $name");
		if($name == 'data')
			return;
		
		if(in_array($name, $this->publicAccessible)){
			$this->{$name} = $val;
		}
		
		$this->data[$name] = $val;
	}
	
	function __toString() {
		return "User: name = {$this->name}; age = {$this->age}; ";
	}
	
	function __destruct(){
		p("User: destruct");
	}
}


$user1 = new User("Wasya Krasauchik", 20, "odmincheg");
p($user1);

$user2 = new User("Mykola", 0);
$user2->age = 30;
$user2->role = "super-guru";
$user2->hatColor = "green";

p("User Data: {$user2->name}; {$user2->age}; {$user2->role}; {$user2->hatColor}; ");

$fields = get_object_vars($user1);
pr($fields);

