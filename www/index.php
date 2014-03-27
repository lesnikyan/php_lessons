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
