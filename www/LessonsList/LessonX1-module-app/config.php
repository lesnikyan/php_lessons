<?php
defined('MAIN_ENTRY_POINT') ||  die('incorrect request entry point');

Config::init([
	'db' => [
		'name' => 'moduled_app',
		'host' => 'localhost',
		'port' => 3306,
		'user' => 'root',
		'pass' => '1'
	],
	// modules: url_name => classPath
	'modules' => [
		'auth' => 'AuthModule',
		'default' => 'DefaultModule'
	]
]);
