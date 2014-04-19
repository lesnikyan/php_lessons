<?php

if(! is_dir('tmp')){
	die('No text source! Please make tmp dir and put texts.');
}

$files = scandir('tmp');
foreach($files as $i => $file){
	if(preg_match('|^\.+$|', $file)){
		unset($files[$i]);
	}
}
$textList = array_values($files);
//p($files);
