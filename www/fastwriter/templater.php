<?php

defined('ROOT_DIR') || die ('incorrect include!');

class Template {

	protected $file;
	
	protected $template = '';
	
	protected $renderedResult = '';
	
	protected $data = array();
	
	function __construct($file, $data = array()){
		$this->file = ROOT_DIR . '/' . $file . '.php';
		$this->loadTpl($this->file);
		$this->data = $data;
	}
	
	function loadTpl($file){
		if(!file_exists($file)){
			throw new Exception("No tpl file");
		}
		$this->template = file_get_contents($file);
	}
	
	function render ($immediatelyPrint=false){
		ob_start();
		extract($this->data);
		eval("?>{$this->template}<?");
		$this->renderedResult = ob_get_contents();
		ob_end_clean();
		if($immediatelyPrint){
			print $this->renderedResult;
		}
		return $this->renderedResult;
	}
}

class View extends Template {}