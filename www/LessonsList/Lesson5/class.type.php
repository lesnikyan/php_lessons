<?php
header('Content-Type: text/html; charset=utf-8');
function p($x){print "<div>$x</div>";}

function pr($x){
	print "<pre>\n"; print_r($x); print "</pre>\n";
}

// class types

function printInfo(HasInfo $obj){
	p($obj->info());
}

interface HasInfo{
	function info();
}

class A1 implements HasInfo{
	var $info = 'A1: about us';
	function info(){
		return $this->info;
	}
}

class B1 extends A1{}

$a1 = new B1();
if(is_a($a1 , 'HasInfo')){
	printInfo($a1);
} else {
	p('Не то, касатик!');
}

// pr(get_declared_classes());
