<?php

function p($x){print "<div>$x</div>";}

function vd($x){
	print "<pre>\n"; var_dump($x); print "</pre>\n";
}

class User {
	
	public $name;
	private $age;
	protected $position;
	
	function __construct($name, $age, $pos){
		p('User created');
		$this->name = $name; // this.name , @name 
		$this->age = $age;
		$this->position = $pos;
	}
	
	function __destruct(){
		p('User destructed');
	}
}

function test1(){
	p('start test');
	$user = new User('Vasya Pupkin', 23, 'manager');
	vd($user);
	p('end test');
}

test1();
p('after test 1');

//$arr = array(1,2,3,'qwe');
//vd($arr);

