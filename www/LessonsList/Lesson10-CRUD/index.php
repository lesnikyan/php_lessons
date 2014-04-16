<?php

// start

// load classes

include '../common.php';
include 'db.php';

// define target
$segments = array_keys($_GET);
//pr($segments);

// load target script
// [context , action, param]
// context_action 
if(count($segments) < 2)
	die('incorrect request');
$target_script = "{$segments[0]}_{$segments[1]}.php";
//p($target_script);

if(! file_exists($target_script)){
	die('target file not found!');
}

include $target_script;

// end