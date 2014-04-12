<?php
// примесь
trait MoveAction{
	protected function inAction(){ return "На прогулке "; }
}
//интерфейс
interface Movable{
	function walk();
}
//базовый абстрактный класс
abstract class Animal implements Movable{
	use MoveAction;
//	abstract function walk();
}
//реализация 1
class Dog extends Animal{
	function walk(){
		print $this->inAction() . $this->run() . "<br />";
	}
	function run(){return "цобак бегает";}
}
// реализация 2
class Fish extends Animal{
	function walk(){
		print $this->inAction() . $this->swim() . "<br />";
	}
	function swim(){
		return "рыба плавает";
	}
}
// using Movable interface
function walkZoo(Movable $animal){
	$animal->walk();
}
// testing
$animals = [new Dog, new Fish];

foreach($animals as $one){ walkZoo($one); }


