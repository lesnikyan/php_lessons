<?php
function p($x){print "<div>$x</div>";}

function pr($x){
	print "<pre>\n"; print_r($x); print "</pre>\n";
}

include_once 'namespace.php';
include_once 'namespace2.php';

$user = new \Auth\User();
p($user->test());

$userData = new \Database\User();
pr($userData->data());

