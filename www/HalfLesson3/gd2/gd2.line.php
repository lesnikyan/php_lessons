<?php


$image = imagecreate (800, 600);

$black = imagecolorallocate($image, 0, 0, 0);
$red = imagecolorallocate($image, 255, 0, 0);

imagefill($image, 0, 0, $black);
imageline($image, 0, 0, 800, 600, $red);
imageline($image, 0, 600, 800, 0, $red);

$imagePath = 'images/line.png';

$s2 = imagepng($image, $imagePath);
imagedestroy($image);

print "<img src='{$imagePath}' />";

