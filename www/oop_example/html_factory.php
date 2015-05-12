<?php

namespace HtmlFactory;

class h {
	private $data;
	const OnePartTags = ['hr', 'br', 'input', 'meta'];
	
	function tag($name, $content=null){
		return new Tag($name, $content);
	}
	
	function div($content){
		return $this->tag('div', $content);
	}
	
	function span($content){
		return $this->tag('span', $content);
	}
	
	function table($rows){
		$content = 'TODO:rows';
		return $this->tag('table', $content);
	}
	
	function p($content){
		return $this->tag('p', $content);
	}
	
	function hN($content, $n=1){
		return $this->tag('h' . $n, $content);
	}
	
}

class Tag {
	private $name;
	private $closable = true;
	private $children = [];
	
	function __construct($name, $content){
		$this->name = $name;
		if(in_array($name, h::OnePartTags)){
			$this->closable = true;
		}
	}
	
	function isClosable(){
		return $this->closable();
	}
	
}

class TagRenderer {
	private $tags = [];
	private $current;
	private $tab;
	
	function __construct($tags=[]){
		$this->tags = $tags;
	}
	
	function render($res = ''){
		return $res;
	}
	
	static function html($tags){
		$renderer = new TagRenderer($tags);
		return $renderer->render();
	}
}