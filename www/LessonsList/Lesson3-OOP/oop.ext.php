<?php

function p($x){print "<div>$x</div>";}

function vd($x){
	print "<pre>\n"; var_dump($x); print "</pre>\n";
}


abstract class Animal {
	protected $name;
	protected $data = [];
	abstract function walk();
	function test1(){ print 'Animal test 1'; }
}

class Dog extends Animal{

	function __construct($name){
		$this->name = $name;
	}
	
	function walk(){
		return ' runs';
	}
	
	function test1(){ 
		p('Dor test 1'); 
		parent::test1(); 
	}
	
	//*************************
	
	function getName(){
		return $this->name;
	}
	
	
	function setName($name){
		$this->name = $name;
	}
	
	function __set($name, $value){
		if($name == 'name')
			$this->name = $value;
		$this->data[$name] = $value;
	}
	
	function __get($name){
		if($name == 'name')
			return $this->name;
		return $this->data[$name];
	}
}

$dog = new Dog('Bobik');

p("dog " . $dog->getName());
p("dog {$dog->name}");
$dog->name = 'Tuzik';
p("dog {$dog->name}" . $dog->walk());
$dog->test1();

class A{
	protected $x;
	const z = 45;
	function __construct($x){$this->x = $x;}
}
class B extends A{
	private $y;
	function __construct($x, $y){$this->y = $y; parent::__construct($x);}
}
$b = new B(12,34);
vd($b);
p(B::z);


