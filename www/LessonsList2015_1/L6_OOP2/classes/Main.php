<?php

class Main {
	function run(){
		$this->view('Main page content');
	}
	
	function info(){
		$this->view("some very important info of portal!");
	}
	
	function view($content){
		//include ROOT_DIR . '/tpl/main.php';
		$view = new View('main', ['content' => $content]);
		$view->render();
	}
}