<?php
session_start();

$clear = isset($_GET['clear']);

if($clear AND isset($_SESSION['count']) AND $_SESSION['count'] == 0){
	header("HTTP/1.0 404 Not Found");
	exit;
}

if($clear){
	unset($_SESSION['count']);
}

if(!isset($_SESSION['count'])){
	$_SESSION['count'] = 0;
} else {
	$_SESSION['count']++;
}
print 'Count = ' . 	$_SESSION['count'];