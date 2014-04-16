<?php

function p($x){print "<div>$x</div>";}

function pr($x){
	print "<pre>\n"; print_r($x); print "</pre>\n";
}


// *********************
function printName($data){
	p($data->name);
}

$user = (object) array('name' => 'Vasya');
pr($user);
printName($user);

//**********************

$user2 = new StdClass();
$user2->name = 'Kolya';
pr($user2);
printName($user2);

//**********************

class User{
	public $name;
	const STATUS = 'superman';
	function __construct($name){
		$this->name = $name;
	}
	function getName(){return $this->name;}
}

$user3 = new User('Olya');
pr($user3);
printName($user3);
//***************
//p(gettype((int)intval('123')));

function printNameArr($data){
	p('arr_data = '.$data['name']);
}

$user2arr = get_object_vars($user2);
pr($user2arr);
printNameArr($user2arr);

$user3arr = get_object_vars($user3);
pr($user3arr);
printNameArr($user3arr);


$users = array(
	array('name'=> 'u1', 'surname'=> ''),
	array('name'=> 'u2', 'surname'=> ''),
	array('name'=> 'u3', 'surname'=> '')
);


