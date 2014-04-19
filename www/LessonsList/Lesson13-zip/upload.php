<?php include '../common.php';

//p($_FILES);

$tmp = $_FILES['arch']['tmp_name'];

if(!file_exists($tmp)){
	die('no file!');
}

$zip = new ZipArchive;
$zip->open($tmp);
if($zip->extractTo('./docs')){
	p('Archive extracted!');
}