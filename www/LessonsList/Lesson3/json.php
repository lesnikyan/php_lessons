<?php 
function p($x){print "<div>$x</div>";}

function vd($x){
	print "<pre>\n"; var_dump($x); print "</pre>\n";
}

// json_encode
$arr = [1,2,3];
$obj = new StdClass();
$obj->name = "Vasya";
vd($obj);
$arr[] = $obj;
$json = json_encode($arr);
p($json);

// json_decode
$data = json_decode($json, 1);
p('data:');
vd($data);

// file_put_contents

file_put_contents('data/info.txt', $json, FILE_APPEND);
p(file_get_contents('data/info.txt'));

