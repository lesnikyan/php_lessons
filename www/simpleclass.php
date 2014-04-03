<?php

function p($x='none'){print "<div><pre>$x</pre></div>\n";}
function vd($x='none'){print "<div><pre>"; var_dump($x); print "</pre></div>\n";}


$ob = new StdClass();
$ob->name = 'Vasya';
vd($ob);
$ob2 = (object) array('name' => 'Vasya');
vd($ob2);

function foo($x){p('foo-name = '.$x->userName);}

class Bar{
	var $userName = 'Vasya';
	static $counter = 0;
	var $id;
	function __construct(){ $this->increse(); }
	private function increse(){ $this->id = self::$counter++; }
	function __clone(){ $this->increse(); p('Bar-clone objId = '. spl_object_hash($this) ); }
}

$bar = new Bar();
vd($bar);
foo($bar);

$bar3 = clone $bar;
vd($bar3);

p('is $bar3 instance of Bar? - ' . (is_a($bar3, 'Bar') ? 'Yes' : 'No'));

$time1 = microtime(1);
vd($time1);

for($i=0; $i<1000000;++$i){
	$ob = array('type' => 'animal');
}
$time2 = microtime(1);
for($i=0; $i<1000000;++$i){
	$ob = (object) array('type' => 'animal');
}
$time3 = microtime(1);
for($i=0; $i<1000000;++$i){
	$ob = new StdClass;
	$ob->name = 'animal';
}
$time4 = microtime(1);

p('array time = ' . ($time2 - $time1));
p('object time = ' . ($time3 - $time2));
p('stbObj time = ' . ($time4 - $time3));
