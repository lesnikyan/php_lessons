<?php
defined('MAIN_ENTRY_POINT') ||  die('incorrect request entry point');

foreach([
	'Config',
	'ClassLoader',
	'Router'
] 
	as $className){
	require_once DOC_ROOT . "/app_core/{$className}.php";
}
