<?php

session_start();

include 'session_menu.php';

if(isset($_SESSION['lastTime'])){
	$curTime = time();
	print "<div> cur: $curTime, last: {$_SESSION['lastTime']}</div>";
}

if(isset($_SESSION['userData'])){
	print "<div>{$_SESSION['userData']}</div>";
}