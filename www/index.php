<?php
function p($x=''){print "<div>$x</div>";}
function imp($arr){
	if(count($arr) > 5){$arr = array_slice($arr, 0, 5); $arr[] = ' ...';}; 
	return '[' . implode(',', $arr) . ']';
}
print 'php test runned <pre>';

$x = 12;
$y = 2 * 3;
$z = $x + $y;

print " z = $z \n";

print gettype(123) . "  \n";

$foo = function(){ p ('foo func'); };
$foo();

$lambda = create_function('$a, $b, $c', 'return " $a * $b * $c = " . $a * $b * $c;');
p($lambda (3,4,5));

p('call_user_func_array = ' . call_user_func_array($lambda, array(2,3,4)));

//function lnktest($x){ $x[] = 5; return $x;}
function lnktest(&$x){ $x[] = 5; return $x;}
p(imp(array(1,2,3,4,5,6,7,8,9)));
$lnk = array(8);
$lnk2 = lnktest($lnk);
p("lnk = ". imp($lnk) . " lnk2 = " . imp($lnk2));
$lnkname = 'lnktest';
$lnkNameVal = array(2,3);
p("lnkName = " . imp($lnkname($lnkNameVal)));