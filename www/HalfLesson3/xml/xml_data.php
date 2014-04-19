<?php

include '../common.php';
// SimpleXML
$sxml = simplexml_load_file('db_data.xml');

$xpath = '/data/users/admins/person';
//$xpath = '/data/users/admins/person/@name';
$selected = $sxml->xpath($xpath);

// foreach($selected as $element){	print_r($element); print "<br>";}
// exit;

$admins = [];
foreach($selected as $element){
	$adm = [];
	$attr = $element->attributes();
	$adm['name'] = (string) $attr->name;
	$adm['surname'] = (string) $attr->surname;
	$adm['age'] = (int) $attr->age;
	$admins[] = $adm;
}

$tabstyle = ['th' => 'color: gray', 'td' => 'color: #4040ff', 'table' => 'margin: 20px;'];

print html_table($admins, $tabstyle) . "\n\n";

// **************************************
function xml2array( $xmlNodes, $fields ){
	$res = [];
	foreach($xmlNodes as $node){
		$elem = [];
		$attr = $node->attributes();
		foreach($fields as $field){
			$elem[$field] = (string) $attr->{$field};
		}
		$res[] = $elem;
	}
	return $res;
}


$xpath2 = '/data/users/moderators/person';
$selected2 = $sxml->xpath($xpath2);

$moders = xml2array($selected2, ['name', 'surname', 'age']);
$tabstyle['td'] = 'color: #ff4040';
print html_table($moders ,$tabstyle) . "\n\n";

// ***************


$xpath3 = '//person[@age>23]';
$selected3 = $sxml->xpath($xpath3);

$byAttr = xml2array($selected3, ['name', 'surname', 'age']);
$tabstyle['td'] = 'color: #40d040';
print html_table($byAttr ,$tabstyle) . "\n\n";



