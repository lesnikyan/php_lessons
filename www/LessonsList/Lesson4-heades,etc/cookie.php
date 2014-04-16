<?php

function p($x){print "<div>$x</div>";}

function pr($x){
	print "<pre>\n"; print_r($x); print "</pre>\n";
}

setcookie('key1', 'value 1', (time() + 1));
pr($_COOKIE);

// 