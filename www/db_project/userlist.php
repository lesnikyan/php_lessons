<?php

include 'core.php';

$db = new DB(
	$dbconf->host, 
	$dbconf->login, // 'root', //
	$dbconf->pass,
	$dbconf->dbname
);

$tabStyle = ['table' => 'border:1px solid red;', 
'td' => 'border:1px solid red;',
'th' => 'border:1px solid #ee4400;'];

$res = $db->query("show tables;")->queryResult();


print html_table($res, $tabStyle);

$users = $db->query("SELECT * FROM `users`;")->queryResult();
print html_table($users, $tabStyle);