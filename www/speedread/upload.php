<?php
header('Content-Type: application/json; charset=utf-8');
$file = 'test1.txt';
$ext = 'txt';
if(isset($_POST['file']) AND preg_match('|[\w]+\.'.$ext.'|', $_POST['file'])){
	$file = $_POST['file'];
}
$text = file_get_contents("tmp/$file");
$text = str_replace("\n", ' ', $text);
sleep(1);
print json_encode(['text' => $text]);