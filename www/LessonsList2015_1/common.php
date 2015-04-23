<?php


function p($x){print "<div>$x</div>";}

function pr($x){
	print "<pre>\n"; print_r($x); print "</pre>\n";
}

function pa($arr){
	print "<div>[" . implode(', ', $arr) . "]</div>\n";
}
