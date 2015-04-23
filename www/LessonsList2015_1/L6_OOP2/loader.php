<?php

include_once '../common.php';
define ('ROOT_DIR', __DIR__);

include_once 'View.php';

function checkFile($classname){
	$file = ROOT_DIR . '/classes/' . $classname . '.php';
	return file_exists($file);
}

spl_autoload_register(
	function ($classname){
		$file = ROOT_DIR . '/classes/' . $classname . '.php';
		if(file_exists($file)){
			require_once $file;
		}
	}
);

$module = isset($_GET['module']) ? $_GET['module'] : 'main';
$className = ucfirst($module);

if(!checkFile($className)){
	die("Error 404! Sorry ^.^");
}

//p($className);

$moduleInstance = new $className();

// loader.php?module=userInfo&action=info&param[]=1

$method = isset($_GET['action']) ? $_GET['action'] : 'run';

//$moduleInstance->run();
//pr($_GET);

$params = isset($_GET['param']) ? $_GET['param'] : [];

//$moduleInstance->$method();

call_user_func_array([$moduleInstance, $method], $params);

