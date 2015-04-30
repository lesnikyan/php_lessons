<?php

function p($x){print "<div>$x</div>";}
function pr($x){
	print "<pre>\n"; print_r($x); print "</pre>\n";
}
// C R U D
// create user 'webdev'@'localhost' identified by '1';
$host = 'localhost';
$dbname = 'php3_test1';
$user = 'root';
$pass = '';

$connection = mysql_connect($host, $user, $pass);
//p(gettype($connection));
print $connection ? 'connected' : 'no';

if(! $connection){
	die('DB connection didn\'t create');
}
mysql_select_db($dbname, $connection);


function queryRezult($sql, $connection){
	if(!$connection)
		return null;
	$queryResult = mysql_query($sql, $connection);
	$numRows = mysql_num_rows($queryResult);
	$data = [];
	for($i = 0; $i < $numRows; ++$i){
		$rowData = mysql_fetch_assoc($queryResult);
		$data[] = $rowData;
	}
	return $data;
}

$data = queryRezult("SELECT * FROM `users` WHERE id < 5 ", $connection);

pr($data);

/*
 * 
 включение логирования запросов MYSQL
SET GLOBAL log_output = "FILE";
SET GLOBAL general_log_file = "C:\\\\logging\\mysql_logfile.log";
SET GLOBAL general_log = 'ON';
  */