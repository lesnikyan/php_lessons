<?php

include '../../common.php';

$res = exec('dir C:\\', $out);
//$res = exec('ipconfig', $out);

//p($out);

foreach($out as $str){
	$str = htmlspecialchars(trim($str));
	print("$str<br>\n");
}

