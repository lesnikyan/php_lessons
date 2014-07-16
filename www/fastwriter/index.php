<?php
header('Content-Type: text/html; charset=utf-8');
mb_internal_encoding('utf8');
define('ROOT_DIR', __DIR__);

define('BASE_URL_PATH', '/fastwriter');

foreach(
	array(
		'functions.php',
		'router.php',
		'module.php',
		'templater.php'
	) 
	as $incFile){
	require_once $incFile;
}

// p($_SERVER);

try{
	Router::init()->run();
} catch(Exception $e) {
	//print "<span style='color:red;'> Exception: " . $e->getMessage() ."</span>";
	$excData = array(
		'errorMsg'	=> $e->getMessage(),
		'points'	=> $e->getTrace()
	);
	(new View('exception.tpl', $excData))->render(true);
} 


