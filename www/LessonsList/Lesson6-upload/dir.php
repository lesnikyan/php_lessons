<?php
header('Content-Type: text/html; charset=utf-8');
function p($x){print "<div>$x</div>";}

function pr($x){
	print "<pre>\n"; print_r($x); print "</pre>\n";
}

define('ROOT_DIR', __DIR__);

p('start script dir = ' . __DIR__);
p('start root dir = ' . ROOT_DIR);
p('start script file = ' . __FILE__);

include 'sub/subscript.php';

include ROOT_DIR. "/sub/tpl/tpl1.php";

//***********************************
p('//***********************************');

$files = scandir(ROOT_DIR. "/sub");
pr($files);

if(0)
foreach($files as $fileName){
	p($fileName. ' | is ' . (is_file(ROOT_DIR. "/sub/" . $fileName)? 'file' : 'not file') );
	p($fileName. ' | is ' . (is_dir(ROOT_DIR. "/sub/" . $fileName)? 'dir' : 'not dir') );
}


p('current dir = ' . getcwd());
chdir(ROOT_DIR. "/sub");
p('current dir = ' . getcwd());

