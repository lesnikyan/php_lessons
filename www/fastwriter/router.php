<?php

class Router {
	
	private static $instance = null;

	private $rules = array(
		'default' => array('application' , 'index', array()),
		'load'	=> array('application', 'load', array(4,3,2)),
		'|[\w\-\.]+|' => array(0, 1, null)
	);
	
	private $defMethod = 'index';
	
	private $baseUri = 'fastwriter';
	
	private $callOptions = null;

	static function init(){
		if(!self::$instance){
			self::$instance = new self();
		}
		self::$instance->instInit();
		return self::$instance;
	}
	
	function instInit(){
	//	p($_SERVER['REQUEST_URI']);
		function regex($str){
			//p('reg - ' . $str);
			return preg_match('#^\|.*\|[a-zA-Z]*$#', $str) 
			|| preg_match('|^\#.*\#[a-zA-Z]*$|', $str);
		}
		
		$uri = trim(substr( trim($_SERVER['REQUEST_URI'], '/') , strlen($this->baseUri)) , '/');
	//	p($uri);
		$posQM = strpos($uri, '?'); // pos of Question mark
		$path = ($posQM === false) ? $uri : substr ($uri, 0, $posQM);
		$segments = explode('/', $path);
		$selectedRule = null;
		//p($segments);
		if(count($segments) == 0 || $segments[0] == trim('')){
			$selectedRule = 'default';
		} else {
			foreach($this->rules as $rule => $options){
				//p(regex($segments[0]));
				if($segments[0] === $rule || ( regex($rule) && preg_match($rule, $path) )){
					$selectedRule = $rule;
					break;
				}
			}
		} 
	//	p("!!! $selectedRule ");
		if(!$selectedRule){
			throw new Exception('No routing rule');
		}
		$options = $this->rules[$selectedRule];
		// p("selected [$selectedRule] = " . json_encode($options));
		$module = is_int($options[0]) ? $segments[$options[0]] : $options[0];
		if(count($segments)>1)
			$action = is_int($options[1]) ? $segments[$options[1]] : $options[1];
		else
			$action = $this->rules['default'][1];
		
		$params = array();
		
		// if options[2] has numbers, get segments by numbers, than other segments add to given array
		
		if(isset($options[2]) && $options[2]){
			$paramKeys = $options[2];
			foreach($paramKeys as $key){
				if(isset($segments[$key])){
					$params[] = $segments[$key];
				} else {
					break;
				}
			}
			$params = array_merge($params, array_diff_key($segments, array_flip($paramKeys)));
		} else {
			if(count($segments) > 2){
				$params = array_slice($segments, 2);
			}
		}
		$this->callOptions = (object) array(
			'module' => $module,
			'action' => $action,
			'params' => $params
		);
		//p($this->callOptions);
	}
	
	function run(){
	//	p('run .. 123');
		if(!$this->callOptions){
			throw new Exception("Can't execute null routing");
		}
		$module = $this->loadApplicationClass($this->callOptions->module);
		if(!$module){
			throw new Exception("Can't run null module");
		}
		if(!method_exists($module, $this->callOptions->action)){
			throw new Exception("Can't run null action");
		}
		call_user_func_array(array($module, $this->callOptions->action), $this->callOptions->params);
	}
	
	function loadApplicationClass ($name){
		$class = ucfirst($name);
		$file = $name . '.php';
		//p(" load = $file $class  ");
		if(!file_exists($file)){
			throw new Exception("App file didn't exixts");
		}
		//p('normal load');
		if(!require_once($file)){
			throw new Exception("App file didn't load");
		}
		if(!class_exists($class)){
			throw new Exception("App class didn't exists");
		}
		return new $class;
	}

}