<a href="get.php?page=1">page 1</a>
<a href="get.php?page=2">page 2</a>
<br>
<?php

$page = $_GET['page'];
$path = "./data/$page.txt";
if(file_exists($path)){
	$content = file_get_contents($path);
	print "<div style=\"color:green\">$content</div>";
	//include $path;
}

?>
<br>
[super banner]