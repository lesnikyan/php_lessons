<?php

include 'common.php';

$x = [];
class A{};
$x = new A;
print is_array($x) ? 'ob' : 'no ob'; print '<br>';
print gettype($x);

p('123');
p(true);
p([1,2,3]);
p((object)['name'=>'Kolya', 'surname'=>'Babkin']);