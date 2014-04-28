<?php
session_start();

if(isset($_GET['clear'])){
	unset($_SESSION['count']);
}

if(!isset($_SESSION['count'])){
	$_SESSION['count'] = 0;
} else {
	$_SESSION['count']++;
}
print 'Count = ' . 	$_SESSION['count'];