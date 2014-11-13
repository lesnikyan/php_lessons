<?php
defined('MAIN_ENTRY_POINT') || header("HTTP/1.0 404 Not Found") && die('incorrect request entry point');

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
