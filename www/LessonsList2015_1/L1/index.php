<?php
print "<h1>Hello from plane PHP!!!!</h1>\n";


$x = 1;
$y = 2;
$z = 1.5;

print "<br>\n";
print $x + $y;
print "<br>\n";


$isUser = true;
$isUser = TRUE;
$isNot = false;

$someObject = NULL;

$users = array('Vasya', 'Kolya', 'Petya', 'Olya', 'Masha');
$numbers = [1, 2, 3, 4.5];

$option = ['first_name' => 'Vasya', 'last_name' => 'Pupkin', 'age' => 25];

//$option['first_name'];

print "<span style='color:#000088'>option:name = {$option['first_name']} </span> <br>\n";

// *********************************

/*
comment :)
*/

# perl-style comment

$i = 10;
while($i > 0){
//	print "while cycle: " . $i . "<br /> \n";
	$i--;
}

for($i=0; $i < 10; ++$i){
//	print "for index = $i <br>\n";
}
 
foreach($users as $key => $val){
//	print "Users: \$key = $key, \$val = $val <br>";
}


foreach($users as $val){
	print "Users:  \$val = $val <br>";
}

$userData = [
	'fName' => 'Mykola',
	'lName' => 'Pylypenko',
	'age' => 78,
	'gender' => true,
	'weight' => 80,
];

$table = "<table border='1'>\n";
foreach($userData as $field => $val){

	$style = 'style="color: #004400; background-color: #ffff00; border: 1px solid #a0a0a0;" ';

	$table .= "<tr>\n";
	$table .= "<td $style>{$field}</td>\n";
	$table .= "<td $style>{$val}</td>\n";
	$table .= "</tr>\n";
}
$table .= "</table>";

print "<div>{$table}</div>";

$text = <<<EOF
Meni 13-j mynalo...<br>
Ya pas yagnyata...<br>
EOF;

print $text;

// define, defined

define('USER_ACCESS', 'Admin');

if( defined('USER_ACCESS') ){
	print "Access = ". USER_ACCESS . "<br>";
}

include "1.php";

// $$
$name = 'user';
$user = 'Vasya';
print $$name;
// rand

for($i=0; $i<50; ++$i){
	$color = rand(0, 255);
	print "<div style='background-color: rgb($color, 0, 0); height: 3px;'></div>";
}




