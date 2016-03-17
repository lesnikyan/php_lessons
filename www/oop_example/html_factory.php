<?php

namespace HtmlFactory;

class h {
	private $data;
	
	/**
	 * 
	 * @param type $name
	 * @param type $content
	 * @param type $attrs
	 * @param type $format
	 * @return \HtmlFactory\Tag
	 */
	function tag($name, $content=null, $attrs=null, $format=null){
		return new Tag($name, $content, $attrs, $format);
	}
	
	function block($name, $nodes=null, $attrs=null, $format=null){
		return new ContainerTag($name, $nodes, $attrs, $format);
	}
	
	function div($nodes=null, $attrs=null, $format=true){
		return $this->block('div', $nodes, $attrs, $format);
	}
	
	function span($content=null, $attrs=null, $format=false){
		return $this->tag('span', $content, $attrs, $format);
	}
	
	function table($rows, $attrs, $format=true){
		return new TableTag($rows, $attrs, $format);
	}
	
	function style($nodes=[], $format=true){
		return new StyleTag($nodes, $format);
	}
	
	function script($content='', $src=null){
		$attrs = [];
		$format = false;
		if($src){
			$attr['src'] = $src;
		} else {
			$format = true;
		}
		return $this->tag('script', $content, $attrs, $format);
	}
	
	function p($content=null, $attrs=null, $format=true){
		return $this->tag('p', $content, $attrs, $format);
	}
	
	function hN($n=1, $content=null, $attrs=null, $format=true){
		$n = $n > 6 || $n > 1 ? 1 : $n;
		return $this->tag('h' . $n, $content, $attrs, $format);
	}
	
	function ul($lis, $attrs=null, $format=true){
		foreach($lis as $i => $item){
			if(is_string($item)){
				$lis[$i] = $this->li($item);
			}
		}
		
	}
	
	function li($content=null, $attrs=null, $format=true){
		return $this->tag('li', $content, $attrs, $format);
	}
	
	function form($action='', $method='post', $inputs=[], $attrs=[], $format=true){
		$attrs['action'] = $action;
		$attrs['method'] = $method;
		return $this->block('form', $inputs, $attrs, $format);
	}
	
	function input($type, $name, $value, $attrs=[], $format=false){
		$attrs['type']  = $type;
		$attrs['name']  = $name;
		$attrs['value'] = $value;
		return $this->tag('input', '', $attrs, $format);
	}
	
	function textarea($name, $options, $attrs=[], $format=false){
		$attrs['name'] = $name;
		return $this->block('textarea', $options, $attrs, $format);
	}
	
}

interface TagNode {
	function render();
}

class TextNode implements TagNode {
	protected $content;
	
	function __construct($content='') {
		$this->content = $content;
	}
	
	function render(){
		return $this->content;
	}
}

class Tag implements TagNode {
	protected $name;
	protected $content = '';
	protected $attrs = [];
	protected $closable = true;
	protected $children = [];
	protected $format;
	
	protected static $OnePartTags = ['hr', 'br', 'input', 'meta', 'img', 'link'];
	
	function __construct($name, $content=null, $attrs=null, $format=true){
		$this->name = $name;
		$this->closable = in_array($name, self::$OnePartTags);
		if($content !== null){
			$this->content = $content;
		}
		if(is_array($attrs)){
			$this->attrs = $attrs;
		}
		$this->format = $format;
	}
	
	function addNode(TagNode $node){
		$this->children[] = $node;
	}
	
	function removeNode($index){
		if($index < count($this->children)){
			unset($this->children[$index]);
		}
		$this->children = array_values($this->children);
	}
	
	function isClosable(){
		return $this->closable;
	}
	
	function render($tab=0){
		$tab++;
		//print "[{$this->name}:$tab]"; 
		$tabStr = $this->format ? str_repeat("\t", $tab) : '';
		$endStr = $this->format ? "\n" : '';
		$res = '';
		if(! empty($this->children)){
			foreach($this->children as $child){
				$res .= $tabStr . $child->render($tab ) . $endStr;
			}
		}
		$attrStr = "";
		if(! empty($this->attrs)){
			$attrStr = " ";
			foreach($this->attrs as $name => $val){
				$attrStr .= "$name=\"{$val}\"";
			}
		}
		$closeOpenTag = ($this->closable ? ' />' : '>') . $endStr;
		//print "[{$this->name} : " . strlen($this->content) . "]";
		$content = strlen($this->content) > 0 ? ($tabStr . $this->content . $endStr) : '';
		$openTag = "<{$this->name}{$attrStr}{$closeOpenTag}";
		$closeTab = $this->format ? str_repeat("\t", ($tab > 0 ? $tab - 1 : 0)) : '';
		$closeTag = $this->closable ? '' : "{$closeTab}</{$this->name}>";
		return "{$openTag}{$content}{$res}{$closeTag}";
	}
	
	function __toString(){
		return $this->render();
	}
	
}

class ContainerTag extends Tag {
	
	/**
	 * 
	 * @param type $name
	 * @param \HtmlFactory\TextNode $nodes
	 * @param type $attrs
	 * @param type $format
	 */
	function __construct($name, $nodes = null, $attrs = null, $format = true) {
		parent::__construct($name, '', $attrs, $format);
		if(is_string($nodes)){
			$nodes = [new TextNode($nodes)];
		} else if(! $nodes){
			$nodes = [];
		}
		$this->children = $nodes;
	}
}

class TableTag extends Tag {
	function __construct($rows = null, $attrs = null, $format = true) {
		parent::__construct('table', null, $attrs, $format);
		if(! $rows){
			$rows = [];
		}
		foreach($rows as $row){
			$r = $row;
			if(!(is_object ($row) && $row instanceof TableRow)){
				if(! is_array($row)){
					continue;
				}
				$r = new TableRow($row);
			}
			$this->addNode($r);
		}
	}
}

class TableRow extends Tag {
	function __construct($cells = [], $attrs = null, $format = true) {
		parent::__construct('tr', null, $attrs, $format);
		if(! $cells){
			$cells = [];
		}
		foreach($cells as $cell){
			$td = $cell;
			if(!(is_object ($cell) && $cell instanceof ContainerTag)){
				if(! is_array($cell)){
					continue;
				}
				$td = new ContainerTag($cell);
			}
			$this->addNode($td);
		}
	}
}

class StyleTag extends Tag {
	
	/**
	 *
	 * @var type array:
	 *	div.article => [
	 *		color => red,
	 *		width => 100px
	 *	]
	 */
	protected $nodes = [];
	protected $format;
	
	/**
	 * 
	 * @param array $nodes
	 * @param type $format
	 */
	function __construct($nodes=null, $format=true) {
		parent::__construct('style', null, [], $format);
		if(! $nodes){
			$nodes = [];
		}
		$this->nodes = $nodes;
	}
	
	public function render($tab=0) {
		print count($this->nodes);
		$endStr = $this->format ? "\n" : '';
		$res = '';
		foreach($this->nodes as $sel => $params){
			$res .= $this->renderNode($sel, $params, $tab+1);
			$res .= $endStr;
		}
		$this->content = $res;
		return parent::render($tab);
	}
	
	protected function renderNode($sel, $params, $tab=1){
		//$res = $this->formatting("{$sel} {", $tab);
		$endStr = $this->format ? "\n" : '';
		$res = "{$sel} {" .$endStr;
		foreach($params as $name => $val){
			$res .= $this->formatting("{$name} : {$val};", $tab + 1);
		}
		$res .= $this->formatting("}", $tab);
		return $res;
	}
	
	protected function formatting($val, $tab){
		$tabStr = $this->format ? str_repeat("\t", $tab) : '';
		$endStr = $this->format ? "\n" : '';
		return "{$tabStr}{$val}{$endStr}";
	}
	
	/**
	 * 
	 * @param type $selector - css selector string
	 * @param type $node - list of css properties
	 */
	function addStyle($selector, $node){
		$this->nodes[$selector] = $node;
	}

}

class StyleNode implements TagNode {
	
	protected $properties = [];
	protected $format;
	
	function __construct($selector, $properties=null) {
		if(! $properties){
			$properties = [];
		}
		$this->properties = $properties;
		$this->format = $format;
	}
	
	public function render($tab=0) {
		$tabStr = $this->format ? str_repeat("\t", $tab) : '';
		$endStr = $this->format ? "\n" : '';
		
	}

}