<?php

p('user login');

function post($name){
	return (isset($_POST[$name])) ? $_POST[$name] : null;
}

$db = new DB('users');

$login = post('login');
$pass = post('pass');
// check

$loginData = array(
	'login' => $login,
	'pass'	=> $pass
);

//$db->create($loginData);

$user = $db->read(4);
pr();


