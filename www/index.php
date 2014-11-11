<?php

$dir = 'LessonsList';
$list = scandir($dir);
foreach($list as $item){
	if(preg_match('#^\.+$#', $item) || !is_dir("$dir/$item")){
		continue;
	}
	print "<a href='$dir/$item'>$item</a><br>\n";
}