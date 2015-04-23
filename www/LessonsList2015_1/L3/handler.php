<?php

function p($x){print "<div>$x</div>";}

function pr($x){
	print "<pre>\n"; print_r($x); print "</pre>\n";
}

function pa($arr){
	print "<div>[" . implode(',', $arr) . "]</div>\n";
}
//************************************

//pr($_POST);

if(!isset($_POST['login']) || !isset($_POST['email']) || !isset($_POST['color'])){
	die("Page forbidden! Evil hacker!!!");
}

$login = $_POST['login'];
$email = $_POST['email'];
$color = $_POST['color'];

?>
<html>
	<head>
		<style type="text/css">
			div.content{
				width: 500px;
				height: 250px;
			}
			div.content>div{
				margin: 25px 10px 0 10px;
				padding-left: 20px;
				border: 1px solid silver;
				width: 480px;
				height: 30px;
				font-weight: bold;
				background-color: <?=$color?>;
			}
		</style>
	</head>
	<body>
		<div class="content">
			<div><?=$login?></div>
			<div><?=$email?></div>
		</div>
	</body>
</html>
