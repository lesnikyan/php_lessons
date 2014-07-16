<?php

class Service extends ApplicationModule {
	function index(){
		p('service page');
	}
	
	function page404($url=''){
		p('Page not found');
	}
}