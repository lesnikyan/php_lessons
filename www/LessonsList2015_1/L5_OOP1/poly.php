<?php

require_once '../common.php';

abstract class Animal {
	abstract function sound();
}

class Cat extends Animal {
	function sound(){
		return ("miau");
	}
}

class Dog extends Animal {
	function sound(){
		return("gaf-gaf");
	}
}

class Pinguin extends Animal {
	function sound(){
		return("piu-piu");
	}
}

class Ondater extends Animal {
	function sound(){
		return("hrum-hrum");
	}
}

class Fish extends Animal {
	function sound(){
		return("");
	}
}

// ******************
function animalChorus(Animal $animal){
	p(get_class($animal) . " say :" . $animal->sound());
}

//****************

$animals = [
	new Cat(), new Dog(), new Fish(), new Ondater(), new Pinguin()
];

foreach($animals as $animal){
	animalChorus($animal);
}