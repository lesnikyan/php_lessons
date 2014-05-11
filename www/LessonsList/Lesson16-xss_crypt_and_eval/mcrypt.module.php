<?php

include '../../common.php';

// example of BLOWFISH encryption

// preparing, options
global $crypt, $vector, $key;
$crypt = mcrypt_module_open(MCRYPT_BLOWFISH, '', MCRYPT_MODE_CBC, ''); // open module
$vector = 'fK7Ax84s';  // len = 8 iv
$key = 'qwertyuiopasdfghjklzxcvbnmQWERTY'; // len = 32
$key = substr($key, 0, mcrypt_enc_get_key_size($crypt)); // shorts $key to max allowed size
p('max key size = ' . mcrypt_enc_get_key_size($crypt));

function encrypt($str){
	global $crypt, $vector, $key;
	mcrypt_generic_init($crypt, $key, $vector);
	$encrypted = mcrypt_generic($crypt, $str);
	mcrypt_generic_deinit($crypt);
	return $encrypted;
}

function decrypt($str){
	global $crypt, $vector, $key;
	mcrypt_generic_init($crypt, $key, $vector);
	$decrypted = mdecrypt_generic ($crypt, $str);
	mcrypt_generic_deinit($crypt);
	return trim($decrypted, "\0");
}

// encryption

$data = array( 'data' => array(1,2,3, 'Vasya'), 'time' => time() ); // source

$xjson = json_encode($data);
p(strlen($xjson));
$encrypted = encrypt($xjson);
$x64 = base64_encode($encrypted);

p($x64); // finally encoded

// decryption
$encrypted2 = base64_decode($x64);
$yjson = decrypt($encrypted2);
$data2 = json_decode($yjson);

p($data2); // finally decoded


mcrypt_module_close ($crypt); // close module



