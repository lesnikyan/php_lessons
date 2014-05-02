<?php

header(Content-Type: text/plane; charset=utf-8);

$names = ['Vasya', 'Olya', 'Viktor', 'John', 'Ali', 'Tom', 'Ricardo', 'Allan'];
$surnames = ['Pupkin', 'Mikhailoff', 'Petrenko', 'MacArtur', 'O\'Genry', 'Po', 'Maradonna', 'Rogriges'];
$xml = '<?xml version="1.0"?>';
$xml .= '<users>';
for($i=0; $i< 20; ++$i){
	$id = 100+$i;
	$nameId = random();
	$surnameId = random();
	$age = random(18, 45);
	$xml .= "<user name=\"$names[$nameId]\" surname=\"$surnames[$surnameId]\" age=\"$age\" id=\"$id\" />";
}
$xml .= '</users>';

print $xml;