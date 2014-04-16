<?php


if(isset($_GET['name2'])){ p('name defined'); } else { p('name undefined'); }

$name = 'Vasya';
$name = 123;
$name = true;
$name = array(1,2,3);
p('type of name = '. gettype($name));
p( 'function ' . (function_exists('foo') ? 'exists' : 'not exists' ));

$var = 'qwerty';
p(is_string($var) ? 'var string' : ' var not string');

$var = '123';
$var = intval($var);
p(is_integer($var) ? 'var int' : ' var not int');

