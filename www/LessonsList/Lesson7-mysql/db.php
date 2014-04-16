<?php
function p($x){print "<div>$x</div>";}

function pr($x){
	print "<pre>\n"; print_r($x); print "</pre>\n";
}

// C R U D


// create user 'webdev'@'localhost' identified by '1';


$host = 'localhost';
$dbname = 'db_lessons';
$user = 'root';
$pass = '';

$connection = mysql_connect($host, $user, $pass);

print $connection ? 'connected' : 'no';

if(! $connection){
	die('DB connection didn\'t create');
}

mysql_select_db($dbname, $connection);

function queryRezult($sql, $connection){
	$queryResult = mysql_query("SELECT * FROM `users` ", $connection);
	$numRows = mysql_num_rows($queryResult);
	$data = [];
	for($i = 0; $i < $numRows; ++$i){
		$rowData = mysql_fetch_assoc($queryResult);
		$data[] = $rowData;
	}
	return $data;
}


$name = 'User' . time();
$login = 'user' . time();

$sql = "INSERT INTO `users` 
	(`name`,`login`,`pass`,`adress`,`age`, `gender`) 
	VALUES ('$name', '$login', '1', '', 20, 'male') ";

if(1)
if(mysql_query($sql, $connection)){
	p('New uer inserted');
}

mysql_query("UPDATE `users` SET `name` = 'Kolya', `login` = 'kolya_krosavcheg' WHERE `id` = 4 ", 
	$connection);
	
mysql_query("DELETE FROM `users` WHERE id = 6 ", $connection);

$data = queryRezult("SELECT * FROM `users` ", $connection);
pr($data);


