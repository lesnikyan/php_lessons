<?php
header('Content-Type: text/html; charset=utf-8');
function p($x){print "<div>$x</div>";}

function pr($x){
	print "<pre>\n"; print_r($x); print "</pre>\n";
}

// class_exists

function getClassInstance($className){
	$fileName = "./classes/$className.class.php";
	//pr($fileName);
	if(! class_exists($className)){
		if(! file_exists($fileName))
			return null;
		require($fileName);
	}
	$x = new $className();
	return $x;
}

$a1 = getClassInstance('A1');
p($a1->test());

$a2 = getClassInstance('A1');
p($a2->test());

// class methods

$context = $_GET['context'];
$className = ucfirst($context).'Action';
p($className);
$userObject = getClassInstance($className);
pr($userObject);
$method = $_GET['action'];
//$info = $userObject->$method();
$classMethods = get_class_methods($className);
pr($classMethods);
$info = null;
if(in_array($method, $classMethods)){
	$id = $_GET['id'];
	$info = call_user_func_array([$userObject, $method], [$id]);
} else {
	p('Нет такой буквы в этом слове!!!');
}
pr($info);


