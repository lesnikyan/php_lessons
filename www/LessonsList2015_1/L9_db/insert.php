<?php

include 'connect.php';

if(empty($_POST)){
	die("Incorrect request!!!");
}

function post($key){
	return isset($_POST[$key]) ? $_POST[$key] : NULL;
}

$name = post('name');
$login = post('login');
$email = post('email');
$age = intval(post('age'));
$pass = post('pass');
$gender = post('gender');

if(
		$name == '' 
		|| $login == ''
		|| $email == ''){
	die("Incorrect empty values!!!");
}

if($gender != 'female'){
	$gender = 'male';
}

$sql = "INSERT INTO `users` (`name`, `login`, `pass`, `email`, `age`,`gender`) "
		. "VALUES ('$name', '$login', '$pass', '$email', $age, '$gender'); ";

$db->query($sql);

header('location: http://test1.com:81/group3/L9_db/mysqli_selection.php');

