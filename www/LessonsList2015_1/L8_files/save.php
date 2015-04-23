<?php

include_once '../common.php';

function toTests($file=''){
	header('location: http://test1.com:81/group3/L8_files/texts.php?file=' . $file);
}
function post($name){
	return isset($_POST[$name]) ? $_POST[$name] : null;
}

//pr($_POST);

define('TEXT_DIR', __DIR__ . '/text_files');

if(empty($_POST)){
	toTests();
}

$text = post('text');

$filename = post('filename');

if(empty($filename)){
	$filename = strval(time()) . '.txt';
}
p($filename);
file_put_contents(TEXT_DIR . '/' . $filename, $text);

toTests($filename);