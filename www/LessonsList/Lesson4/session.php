<?php
session_start();

function p($x){print "<div>$x</div>";}

function pr($x){
	print "<pre>\n"; print_r($x); print "</pre>\n";
}
//$_SESSION['user_name'] = 'Vasya Pupkin';
pr($_SESSION);
p($_SESSION["user_name"]);

