<?php
include '../common.php';
print "<pre>";
$x = 123;
print(serialize($x)); print "<br />\n";
$y = 100.05;
print(serialize($y)); print "<br />\n";
$y = "Vasya Pupkin\nbaran";
print(serialize($y)); print "<br />\n";
$y = [1,2,3,'qwerty'];
print(serialize($y)); print "<br />\n";
$y = ['name'=>'Vasya','sname'=>'Pupkin'];
print(serialize($y)); print "<br />\n";
$y = (object)['name'=>'Vasya','sname'=>'Pupkin'];
print(serialize($y)); print "<br />\n";

$unserial = unserialize('O:8:"stdClass":2:{s:4:"name";s:5:"Vasya";s:5:"sname";s:6:"Pupkin";}');
var_dump($unserial); print "<br>\n";

class User{
	var $name = 'Vasya';
	var $sname = 'Pupkin';
}
$user = new User;
$serialObj = serialize($user);
print($serialObj); print "<br />\n";
$unserialObj = unserialize($serialObj);
var_dump($unserialObj); print "<br />\n";
