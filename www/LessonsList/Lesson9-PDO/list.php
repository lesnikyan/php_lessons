<?php

include '../common.php';

$db = new PDO('mysql:dbname=db_lessons;host=localhost', 'root', '');

//var_dump($db);


if(0){
	//$login = $db->quote($_GET['login']);
	$res = $db->query("SELECT * FROM users WHERE login = 'petya' ");
	$data = $res->fetchAll();
	pr($data);
}

$sql = "SELECT * FROM users WHERE login = ? ";
// set SQL
// prepare statements
$prep = $db->prepare($sql);
$params = array($_GET['login']);
// exec by parameters
$res = $prep->execute($params);
$data = $prep->fetchAll();
//pr($data);

$sql = "SELECT * FROM users WHERE login = :login ";
$assocStat = $db->prepare($sql);
$assocStat->bindParam(':login', $_GET['login']);
$res = $assocStat->execute();
$data = $assocStat->fetchAll();
//pr($data);


include 'mydb.php';

$db = new MyDB('mysql:dbname=db_lessons;host=localhost', 'root', '');
$data = $db->query("SELECT * FROM users WHERE login = :login ", [':login' => $_GET['login']]);

pr($data);
$user = $data[0];
//p("Hello, {$user->name}! ");


