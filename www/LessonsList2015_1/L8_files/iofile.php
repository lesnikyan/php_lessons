<?php 
function p($x){print "<div>$x</div>";}
function pr($x){
	print "<pre>\n"; print_r($x); print "</pre>\n";
}
define('ROOT_DIR', __DIR__);
$h = fopen(ROOT_DIR.'/iofiles/t1.txt', 'a+');
$timeTpl = 'H : i : s';
$time = date($timeTpl) . "\n";
if($h){
	fwrite($h, $time);
	fclose($h);
}
$h = fopen(ROOT_DIR.'/iofiles/t1.txt', 'r+');
if($h){
	while(!feof($h)){
		$text = fread($h, strlen($time));
		p($text);
	}
	fclose($h);
}

