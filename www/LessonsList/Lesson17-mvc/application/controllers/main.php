<?php

class MainController extends Controller{
	
	function index(){
		p('Welcome to the best of the best MAIN!! controller, noob!');
	}
	
	function test123($x=123, $y = 'qwerty', $z = 'Vasya'){
		$message = 'Hello 123 test! x = ' . "$x $y $z";
		$view = Core::view('main_test123');
		$view->setData(array('msg' => $message, 'title' => 'Test 123'));
		$view->userName = $z;
		$html = $view->render(true);
		//print $html;
	}
	
}