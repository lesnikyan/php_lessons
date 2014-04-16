<?php
include '../common.php';
include 'image2base64.php';
// get image list
$time1 = microtime(1);

$dir = 'images';
$images = scandir($dir);
//pr($images);

// make thumbnails
$thumbnails = [];
$imageList = [];
foreach($images as $file){
	if(! preg_match('|cat[\d]+\.jpg|', $file)){
		continue;
	}
	$imageList[] = $file;
	//	p($file);
	$image = imagecreatefromjpeg ($dir . '/' .$file);
	$w1 = imagesx($image);
	$h1 = imagesy($image);
	$w2 = 100; // max mini width
	$h2 = $h1 * $w2 / $w1;
	// resource of mini
	
	// $mini = imagescale($w2, $h2);
	
	$mini = imagecreatetruecolor($w2, $h2); // empty image
	// copy and resize
	imagecopyresampled( $mini, $image, 0, 0, 0, 0, $w2, $h2, $w1, $h1);
	
	$data64 = img2base64($mini);
	$thumbnails[] = [
		'data' => $data64,
		'file' => $file
	];
	imagedestroy($image);
	imagedestroy($mini);
}

$time2 = microtime(1);


// dg2.resizae.php?image=cat01.png
$html = '<div>';
foreach($thumbnails as $image){
	$html .= "<a href='gd2.resize.php?image={$image['file']}'>
		<img src='data:image/png;base64,{$image['data']}' /></a> \n";
}
$html .= "</div>\n";
if(isset($_GET['image']) && in_array($_GET['image'], $imageList))
	$target = $_GET['image'];
else
	$target = $imageList[0];
	
$html .= "<img width='800px' src = 'images/{$target}'>";

$html .= "<div>time = ". ($time2 - $time1) ."</div>\n";

print $html;
