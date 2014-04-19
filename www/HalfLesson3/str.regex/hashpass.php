<?php


function encrypt($str){
	$salt = 'lfyerbt8ghhw0er';
	return md5($salt. md5($str));
}

$host = 'localhost';
$dbname = 'db_lessons';
$user = 'root';
$pass = '';

$connection = mysql_connect($host, $user, $pass);


if(! $connection){
	die('DB connection didn\'t create');
}

mysql_select_db($dbname, $connection);


$pass = encrypt(1);
mysql_query("UPDATE users SET pass = '$pass' ;", $connection);

