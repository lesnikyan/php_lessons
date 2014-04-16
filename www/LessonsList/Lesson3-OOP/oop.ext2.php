<?php


function p($x){print "<div>$x</div>";}

function vd($x){
	print "<pre>\n"; var_dump($x); print "</pre>\n";
}


// Interfases

interface Movable{
	function drive();
}

class Car implements Movable{
	function drive(){
		p('dyr dyr dyr');
	}
}

$car = new Car();
$car->drive();

// Traits

trait Trait1 {
	protected $x = 123;

	function superSort(){ p('Multidata sort ' . $this->x); }
	
	function superFinding(){ p('Multidata find'); }
}

class Network{
	use Trait1;
	function useSort(){
		$this->superSort();
	}
}

$net = new Network();

$net->useSort();