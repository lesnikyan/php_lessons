<?php

// author: sergiolesnik@gmail.com

// PREPARE ENCODING STATEMENT

header("content-type: text/html;charset=utf-8");
mb_internal_encoding('utf8');

// GLOBAL CONSTANTS

define('DOC_ROOT', __DIR__);
define('CORE_DIR', DOC_ROOT . '/lib');
define('APP_ROOT', DOC_ROOT . '/application');


// LOAD CORE FILES

$includes = array(
	'dev.functions',
	'mysql.drv',
	'controller',
	'router',
	'model',
	'view',
	'core'
);

foreach($includes as $fileName){
	$file = CORE_DIR . '/' . $fileName . '.php';
	if(file_exists($file)){
		require_once $file;
	} else {
		die('No core file loaded!');
	}
}

// CORE instance: create and run
$globalTimeVal1 = microtime(1);

Core::instance();
Core::instance()->prepare();
Core::instance()->run();

$globalTimeVal2 = microtime(1);

// p('core run time = ' . ($globalTimeVal2 - $globalTimeVal1));

// memory_get_usage (); 
// 

