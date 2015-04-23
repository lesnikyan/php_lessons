<?php

class View {
	
	private $data = [];
	private $code;
	
	function __construct($tpl, $data = []){
		$this->data = $data;
		$file = ROOT_DIR . '/tpl/' . $tpl . '.php';
		$this->code = file_get_contents($file);
	}
	
	function render(){
		extract($this->data);
		eval('?>' . $this->code . '<?');
	}
}
