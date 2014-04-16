<?php
function p($x){print "<div>$x</div>\n";}

function pr($x){
	print "<pre>\n"; print_r($x); print "</pre>\n";
}

//*******************************


$str = "abcdef Vasya Pupkin";
p($str{0});
p(gettype($str));
p(strlen($str));
p('strstr - '.strstr($str, 'Vasya'));
$strpos = strpos($str, 'Vasya');
p('strpos - '. $strpos );
p('stripos - '. stripos($str, 'vasya') );
p('substr - '. substr($str, $strpos, -3));
$html = "<div>Hello all!</div><script>alert(123);</script>";
$html = htmlspecialchars($html);
p( $html );
p( '[' . trim(' abcdef ') .']' );

$text = <<<EOS
The PHP development team announces the immediate availability of PHP 5.4.26. 
5 bugs were fixed in this release, including CVE-2014-1943';
EOS;

$words = explode(' ', $text);
// pr($words);

$joined = implode('; ', array('123', '456', '678', '890'));
p($joined);

// pr(count_chars ($str, 1));