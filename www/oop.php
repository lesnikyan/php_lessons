<?php

trait MoveAction{
	protected function inAction(){ return "На прогулке "; }
}

interface Movable{
	function walk();
}

abstract class Animal implements Movable{
	use MoveAction;
//	abstract function walk();
}

class Dog extends Animal{
	function walk(){
		print $this->inAction() . $this->run() . "<br />";
	}
	function run(){return "цобак бегает";}
}

class Fish extends Animal{
	function walk(){
		print $this->inAction() . $this->swim() . "<br />";
	}
	function swim(){
		return "рыба плавает";
	}
}

function walkZoo(Animal $animal){
	$animal->walk();
}

$animals = [new Dog, new Fish];

foreach($animals as $one){ walkZoo($one); }


