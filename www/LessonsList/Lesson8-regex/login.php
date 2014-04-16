<?php

header('Content-Type: text/html; charset=utf-8');
function p($x){print "<div>$x</div>";}

function pr($x){
	print "<pre>\n"; print_r($x); print "</pre>\n";
}

/******* DB CONENCTION ***********/
$host = 'localhost';
$dbname = 'db_lessons';
$user = 'root';
$pass = '';

$connection = mysql_connect($host, $user, $pass);


if(! $connection){
	die('DB connection didn\'t create');
}

mysql_select_db($dbname, $connection);

function queryRezult($sql, $connection){
	p($sql);
	$queryResult = mysql_query($sql, $connection);
	if(! $queryResult){
		return [];
	}
	$numRows = mysql_num_rows($queryResult);
	$data = [];
	for($i = 0; $i < $numRows; ++$i){
		$rowData = mysql_fetch_assoc($queryResult);
		$data[] = $rowData;
	}
	return $data;
}

/*  ******** END OF DB *******  */

$login = $_POST['login'];
$pass = $_POST['pass'];

$loginRule = '|^[a-zA-Z][\w\-]{3,31}$|';
$passRule = '#^[a-zA-Z0-9_!\-\,\.]{1,32}$#';

if(
	! preg_match($loginRule, $login)
	OR 
	! preg_match($passRule, $pass)
){
	p('некорректный формат логина или пароля<br><a href="form.php">back</a>');
	exit;
}

$login = mysql_real_escape_string($login);
$pass = mysql_real_escape_string($pass);

function encrypt($str){
	$salt = 'lfyerbt8ghhw0er';
	return md5($salt. md5($str));
}
$pass = encrypt($pass);

$users = queryRezult(
	"SELECT * FROM `users` WHERE login = '{$login}' AND pass = '{$pass}' ;",
	$connection
 );

 if(count($users)){
	p("Welcom to hell!");
//	pr($users);
 } else {
	p("Помий руки, криворучко!");
 }

 // '; insert into users (login, pass, name, adress, age, gender) values('admin','1','','',22,'male');select * from users where '
 
 
 

