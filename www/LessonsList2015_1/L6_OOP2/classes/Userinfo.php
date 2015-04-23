<?php

class UserInfo {
	function run(){
		(new View('main', ['content' => 'Vasya Pupkin the best! Yo!']))->render();
	}
	
	function info($id){
		$this->view("info about user -=$id=-");
	}
	
	function view($content){
		include ROOT_DIR . '/tpl/main.php';
	}
}
