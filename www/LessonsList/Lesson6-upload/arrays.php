<?php
function p($x){print "<div>$x</div>";}

function pr($x){
	print "<pre>\n"; print_r($x); print "</pre>\n";
}

function pa($arr){
	print "<div>[" . implode(',', $arr) . "]</div>\n";
}

$a1 = [1,2,3,4,5];
$a2 = ['a', 'b', 'c', 'd', 'e'];
$a3 = [1,2,'a',3,'c'];
$a4 = [1,3,2,4,6,6,8,1,1,1,2,2,2];

$merged = array_merge($a1, $a2);

pa($merged);

pa(array_unique($a4));

$a5 = ['s', 'a', 'w', 'b', 'y'];
pa($a5);
sort($a5);
pa($a5);

$intersected = array_intersect($a1, $a3);
pa($intersected);

$diff = array_diff($a1, $a3);
pa($diff);

$options = [
	'Vasya' => '1',
	'Petya' => '2'
];
pr(array_flip($options));

if(array_key_exists('Petya', $options))
	p('Yes, I have!!!');

$keys = array_keys($options);
pa($keys);

pa(array_fill(0, 12, 'abs_'));


