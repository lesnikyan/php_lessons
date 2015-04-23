<?php
include_once '../common.php';
// $_FILES;

define('IMAGE_DIR', __DIR__ . "/images");

//pr($_FILES);

if(! is_uploaded_file($_FILES['file_input']['tmp_name'])){
	die("No file, looser!");
}

$fileInfo = $_FILES['file_input'];
$timeFlag = time() . "_";
$fileName = $timeFlag . $fileInfo['name'];
$savePath = IMAGE_DIR . '/'. $fileName;

$copySuccess = move_uploaded_file($fileInfo['tmp_name'], $savePath);

if(! $copySuccess){
	die("Can't copy uploaded file :(");
}
//print "Uploaded!";

header('location: http://test1.com:81/group3/L8_files/gallery.php');

