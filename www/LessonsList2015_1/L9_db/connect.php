<?php

include_once '../common.php';

$param = (object)[
	'host' => 'localhost',
	'port' => 3306,
	'dbname' => 'php3_test1',
	'user' => 'root',
	'pass' => ''
];

// create mysqli connection object
$db = mysqli_connect($param->host, $param->user, $param->pass, $param->dbname, $param->port);

if(! $db){
	die("No db connection");
}
