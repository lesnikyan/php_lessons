<?php

include '../common.php';
include 'mydb.php';

function post($name){
	return (isset($_POST[$name])) ? $_POST[$name] : null;
}

$login = post('login');
$pass = post('pass1');
$pass2 = post('pass2');
$name = post('name');
$adress = post('adress');
$age = intval(post('age'));
$gender = post('gender');

if(strlen($login) < 4)
	die('Login mast have 4 or more characters');
if($pass != $pass2 OR strlen($pass) < 3)
	die('Check password! It should have 3 chars and be identical!');

if($age < 14)
	die('You are too young!');
	
$params = [
	$login, $pass, $name, $adress, $age, $gender
];

$sql = "INSERT 
INTO users (login, pass, name, adress, age, gender) 
VALUES(?, ?, ?, ?, ?, ?);";

$db = new MyDB('mysql:dbname=db_lessons;host=localhost', 'root', '');
$id = $db->insert($sql, $params);

p("inserted user = $id");
