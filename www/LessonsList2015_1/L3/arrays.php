<?php

function p($x){print "<div>$x</div>";}

function pr($x){
	print "<pre>\n"; print_r($x); print "</pre>\n";
}

function pa($arr){
	print "<div>[" . implode(', ', $arr) . "]</div>\n";
}

//****************************************************


p("Array Merging");
$a = [1,2,3,4,5];
$b = [6,7,8,9,0];
$c = array_merge($a, $b, [11, 22, 33, 44]);
pa($c);

$nums = [];
for($i=0; $i<20; $i++){
	$nums[] = mt_rand(10, 99);
}

$nums = array_unique($nums);
p("Sorting:");
pa($nums);
sort($nums);
pa($nums);

p("Fill");
$yos = array_fill(0, 16, "Yo-Yo!");
pa($yos);

$users = [
	'User' => 'red',
	'User123' => 'green',
	'Admin' => 'black',
	'Vasya' => 'blue',
	'Helga' => 'pink',
	'Petro' => 'yellow'
];


pr($users);
pr(array_flip($users));

p("Keys:");
pa(array_keys($users));

p("Values:");
pa(array_values($users));
if(in_array('green', array_values($users))){
	p("values has <span style='green'>green</span>");
}

$user = [
	'fname' => 'Alex',
	'lname' => 'Dow',
	'age' => 98,
	'gender' => 'male',
	'email' => 'noname123@gmail.com',
	'address' => 'Undefined Street, 2/3',
	'petName' => 'Baskervill',
	'phone' => '1-222-333-22-44',
	'someValue' => 'Marivanna Semenovna'
];

p("Intersect Key:");
$keys = ['fname', 'lname', 'email'];
$idata = array_intersect_key($user, array_flip($keys));
pa($idata);

p("Diff Key");
$keys = ['email', 'address', 'someValue' ];
$ddata = array_diff_key($user, array_flip($keys));
pa($ddata);

p(htmlspecialchars("<div>123</div>") );
