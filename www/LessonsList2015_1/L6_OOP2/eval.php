<?php

$code = <<<QQQ
	print 123 + 321;
	class A {
		function test(){
			print "tested eval class";
		}
	   }
QQQ;

eval($code);

$className = 'A';
$a = new $className();
$a->test();
