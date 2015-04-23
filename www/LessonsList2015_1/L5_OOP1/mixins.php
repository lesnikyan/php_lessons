<?php

require_once '../common.php';

class Collection {
	protected $data = [];
	
	function add($obj){
		$this->data[] = $obj;
	}
}

class User {
	public $name;
	function __construct($name) {
		$this->name = $name;
	}
	
	function __toString() {
		return "User:name = {$this->name}";
	}
}

trait CollectionUtil {
	function printAll($data){
		foreach($data as $obj){
			p($obj);
		}
	}
}

class UserList extends Collection {
	
	use CollectionUtil;
	
	function add(User $obj){
		parent::add($obj);
	}
	
	function show(){
		$this->printAll($this->data);
	}
	
}

$users = new UserList();
$users->add(new User("Vasya"));
$users->add(new User("Kolya"));
$users->add(new User("Olya"));
$users->add(new User("Lena"));
$users->add(new User("Ibragim Petrovich"));

$users->show();

