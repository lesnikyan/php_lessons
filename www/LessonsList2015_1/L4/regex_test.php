<?php

require_once '../common.php';

/*
 *	\w* : abcde_123 
 *	\d* : 123456
 *	\s* : ' ',	'	'	
 * 
 */

// number
$expr = '#^\w{3,8}$#iU'; // 3 - 8
$expr = '#^\w*$#iU';	// any
$expr = '#^\w+$#iU';	// 1 - 
$expr = '#^\w?$#iU';	// 1 or no 

// 
$expr = '#\w*#';	// 
$expr = '#[abc]*#';	// abc aaa cba cccaaabbb
$expr = '#[^456]*#';	// abc
$expr = '#[a-zA-Z]*#';	// from 'a' to 'z'
$expr = '#[0-9a-f\#]{6}#';	// #ff00ff, #a0a0a0

$expr = '#(<.*>){3,5}#Ui';	// <tr><td></td></tr>
$expr = '#[a-z0-9]+\.(com|net|org|info|ua|ru)#';	// mail.ru, google.com, php.net

$expr = '|([a-z]+)|'; // 1111 'abc' 000 999 45466787 

foreach([
	'123', 'vasya_megadeth', 'katya1990_150', 'drop database', '!@#$%^&', 'I-=Nagibator=-I', 'semen-petrovych'
] as $login){
	$regex = '#^[a-z][a-z0-9\-\_\=]{2,15}$#i';
	if(preg_match($regex, $login)){
		p("Login ({$login}) is correct.");
	} else {
		p("Get out dirty hacker ({$login}) !");
	}
}