<?php
// base64 from image resource
function img2base64($image){
	ob_start();
	imagepng($image);
	$data = ob_get_contents();
	ob_end_clean();
	$data64 = base64_encode($data);
	return $data64;
}