<?php

// avatar from kitten
// crop image to square
// use fonts

$image = imagecreatefromjpeg('images/cat.jpg');

$black = imagecolorallocate($image, 0, 0, 0);
$red = imagecolorallocate($image, 255, 0, 0);
$yellow = imagecolorallocate($image, 255, 255, 0);
$blue = imagecolorallocate($image, 50, 150, 255);

$font = 1;
//imageloadfont
$text = 'Vasya Pupkin';
//imagestring($image, $font, 10, 150, $text, $yellow);
imagettftext($image, 20, 30, 31, 201, $blue, 
	'fonts/Pee\'s Celtic Plain.ttf', $text);
imagettftext($image, 20, 30, 31, 201, $black, 
	'fonts/Pee\'s Celtic Plain.ttf', $text);
imagettftext($image, 20, 30, 30, 200, $yellow, 
	'fonts/Pee\'s Celtic Plain.ttf', $text);
header('Content-type: image/png');
imagepng($image);
imagedestroy($image);

/*
сделать галлерею
1. заливка файла пост-форма, сохранить на диск /images
2. сделать миниатюру (imagecopyresampled()), сохранить в /mini
3. вывести картинки с меню
*/