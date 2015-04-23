<?php
include_once '../common.php';

$str = "qwertyuiopasdfghjklzxcvbnm1234567890";
$len = strlen($str);
$res = "";

for($i=0; $i<$len; $i++){
	$res .= "[{$str{$i}}]";
}

p($res);
// ****************************

//pr($_SERVER);

$path = $_SERVER['REQUEST_URI'];
p($path);
$segments = explode('/', trim($path, "/"));
pr($segments);

p(htmlspecialchars('<div><a href="">page</a></div>'));