<?php

function p($x=''){
	print "<div>$x</div>\n";
}

function foo($param='no data'){
	return "function foo run: $param";
}

$x = foo('data');
p($x);

$arr = array(1,2,3);
print "<pre>";
function foo2(&$x){
	$x[] = 12;
	return $x;
}
$y = foo2($arr);
//print_r($y);
//print_r($arr);

function names(){
	$args = func_get_args();
	//print_r($args);
	$res = '';
	foreach($args as $name){
		$res .= $name . ' ';
	}
	return $res;
}

$str = names('Vsya', 'Kolya', 'Olya');
p($str);

$lambda = create_function('$a, $b', 'return $a * $b;');
$a = 3; $b = 5;
p("$a * $b = " . $lambda($a, $b));

$sum = function($a, $b){ print "$a + $b = ". ($a + $b) . "<br>\n";};

$sum(33, 44);

function userInfo($a1, $a2, $age){
	p($a1 . $age. $a2);
}

$callFunc = 'p';
$validFunctions = array('userInfo');
// && AND,  || OR
if(isset($_GET['func']) AND in_array($_GET['func'], $validFunctions)){
	$callFunc = $_GET['func'];
}

call_user_func_array(
	$callFunc, 
	array("Vasya Pupkin is superman, ", " years old and very strong!", 25)
);
userInfo("Vasya Pupkin is superman, ", " years old and very strong!", 25);

$data = array(
	array('name' => '', 'surname' => '', 'age' => '', 'adress' => ''),
	array('name' => '', 'surname' => '', 'age' => '', 'adress' => ''),
	array('name' => '', 'surname' => '', 'age' => '', 'adress' => ''),
	array('name' => '', 'surname' => '', 'age' => '', 'adress' => '')
);

print table($data); // <table> ... 

