<?php

// http://ru.wikipedia.org/wiki/Data:_URL
// http://ru.wikipedia.org/wiki/Base64



// create image resource
$image = imagecreate (800, 600);

// create color set
$black = imagecolorallocate($image, 0, 0, 0);
$red = imagecolorallocate($image, 255, 0, 0);
$yellow = imagecolorallocate($image, 255, 255, 0);
$blue = imagecolorallocate($image, 50, 150, 255);

// fill image by black bg
imagefill($image, 0, 0, $black);

// http://us1.php.net/manual/ru/function.imagefilledpolygon.php

$points = [];

$radius = 200;
$alpha = 0; // угол
$vertexNum = 12;
$diff =  2 * pi() / $vertexNum;// щаг угла
$x0 = 400;
$y0 = 300;

for($i=0; $i < $vertexNum; ++$i){
	$alpha = $diff * $i;
	$x = cos($alpha) * $radius + $x0;
	$y = sin($alpha) * $radius + $y0;
	$points[] = $x;
	$points[] = $y;
}

$numPoints = count($points) / 2;
// poligon
imagefilledpolygon($image, $points, $numPoints, $blue);

// ellipce
imagefilledellipse($image, 400, 300, 200, 100, $yellow);

// lines
imageline($image, 0, 0, 800, 600, $red);
imageline($image, 0, 600, 800, 0, $red);

$imagePath = 'images/line.png';

// **** get image data using virtual sub-level of php ****
 
ob_start();

imagepng($image);

$data = ob_get_contents();

ob_end_clean();

// ********* end of sub-level **********

imagedestroy($image);

// print $data; // view binary data

// base64 encoding

$data64 = base64_encode($data);

print "<img src='data:image/png;base64,$data64' />";

