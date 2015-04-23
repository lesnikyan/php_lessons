<?php

require_once '../common.php';

class User {
	private $name;
	
	function __construct($name) {
		$this->name = $name;
	}
	
	function getName(){
		return $this->name;
	}
}

// extends 
class UserWithRole extends User {
	private $role;
	
	function __construct($name, $role) {
		parent::__construct($name);
		$this->role = $role;
	}
	
	function getRole(){
		return $this->role;
	}
}

$oper = new UserWithRole("Sharapov", "oper");
$name = $oper->getName();
$role = $oper->getRole();
pr("User: $name > $role");

// implements interface
interface Driver {
	function drive();
}

class UserWithCar extends User implements Driver {
	public function drive() {
		p("bi-bi, dr-dr-dr");
	}
}

$shofer = new UserWithCar("Semen Petrovych");
$shofer->drive();


abstract class Transport {
	abstract function start();
	abstract function stop();
	abstract function biBi();
}

class Bus extends Transport {
	public function biBi() {
		p("bi-bi");
	}

	public function start() {
		p("dryn-dryn-dryn!!!");
	}

	public function stop() {
		p("Prrrrrr!");
	}

}

$bus = new Bus();
$bus->start();
$bus->biBi();
$bus->stop();
