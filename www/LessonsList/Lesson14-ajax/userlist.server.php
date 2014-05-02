<?php

$names = ['Vasya', 'Kolya', 'Petya', 'Petro', 'John', 'Ricardo'];
$surns = ['Pupkin', 'Belkin', 'Petrenko', 'Smit', 'MacKonahi', 'Maradonna'];

$xml = '<?xml version="1.0"?>';
$xml .= "<users>";
for($i=0; $i<20; $i++){
	$age = mt_rand(15, 45);
	$name = $names[mt_rand(0, count($names) - 1)];
	$surn = $surns[mt_rand(0, count($surns) - 1)];
	$id = 1000 + $i;
	$xml .= "<user name=\"$name\" surname=\"$surn\" age=\"$age\" id=\"$id\" />";
}
$xml .= '</users>';

//print htmlspecialchars($xml); exit;
header('Content-Type: text/xml');
print $xml;

$xml2 = <<<QWE
<?xml version="1.0"?>'<r><sub><sub2 name="Vasya" /></sub></r>
QWE;
///print $xml2;
