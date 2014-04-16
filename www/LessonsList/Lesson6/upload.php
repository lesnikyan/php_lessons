<?
header('Content-Type: text/html; charset=utf-8');
function p($x){print "<div>$x</div>";}

function pr($x){
	print "<pre>\n"; print_r($x); print "</pre>\n";
}

pr($_POST);

pr($_FILES);

$uploadDir = __DIR__ . '/uploaded_files';
$success = false;

if(is_uploaded_file($_FILES['file_input']['tmp_name'])){
	$success = move_uploaded_file(
		$_FILES['file_input']['tmp_name'] , 
		$uploadDir . '/'.  $_FILES['file_input']['name']
	);
}

if($success){
	p('Ай крассавчик да!');
} else {
	p('Ай савсэм некарашо!');
}

