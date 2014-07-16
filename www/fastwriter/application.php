<?php

class Application extends ApplicationModule {

	function __constructor(){
		parent::__constructor();
	}
	
	function index(){
	//	$this->loadDefaultData();
		$tpl = new Template('main.tpl');
		print $tpl->render();
	}
	
	function loadDefaultData($lang = 'en'){
		$chars = $this->chars($lang);
		print (json_encode($chars));
	}
	
	function load(){
		p('load ...');
	}
	
	/**
	* $lang -  language
	* $format - array (false) or string (true)
	*/
	function chars($lang, $format = false){
		//	$src = "qwertyuiopasdfghjklzxcvbnm[];',./"; // контроль
		$src = "jklfdsaghuioprewqytnmvcxzb[];',./";
		//en 8, 10, 7, 7
		if($lang == 'ru'){
		//	$src = "йцукенгшщзхъфывапролджэячсмитьбю.";// контроль
			$src = "олджавыфпрэгшщзкуцйнехътьбюмсчяи.";
			// ru 11, 12, 9, 1
		}
		if($format)
			return $src;
		$chars = str_split($src, 1);
		return $chars;
	}
	
	private function charGroups($part=0, $len=2){
		$groups = array(7, 17, 25, 32);
		if($part > count($groups) - 1){
			$part = count($groups) - 1;
		}
		$uniFile = __DIR__ . '/unisrc.txt';
		if(! file_exists($uniFile))
			return;
		$unitext = file_get_contents($uniFile);
		$chars = $this->chars('en', true);
		$chars = substr($chars, 0, $groups[$part]);
		$rule = '|[' . $chars . ']{'. $len .'}|';
		p($rule);
		preg_match_all($rule,  $unitext, $matches);
		$subwords = $matches[0];
		return $subwords;
	}
	
	private function prepareText(){
		$file = __DIR__ . '/src.txt';
		if(! file_exists($file)) return;
		$text = file_get_contents($file);
		p('strlen = ' . strlen($text));
		$text = strtolower($text);
		$text = str_replace(str_split( '.,:;!&?*()-%/"' . "\n" , 1), ' ' , $text);
		$words = explode(' ', $text);
		p('words after explode' . count($words));
		$words = array_unique($words);
		p('words after unique' . count($words));
		$unitext = implode(' ', $words);
		$uniFile = __DIR__ . '/unisrc.txt';
		file_put_contents($uniFile, $unitext);
	}
	
	function char_test(){
		$subwords = $this->charGroups(2, 4);
		p('found subs = ' . count($subwords));
		p('<hr><textarea name="" id="" cols="100" rows="20">'. json_encode($subwords) . '</textarea>');
	}
	
}