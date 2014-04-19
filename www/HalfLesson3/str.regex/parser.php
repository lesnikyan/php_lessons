<?php

 include '../common.php';

$text = file_get_contents('http://www.kinopoisk.ru/top/');

// p('len = ' . strlen($text));

$text = mb_convert_encoding ($text, 'utf-8', 'cp-1251');

// p('len = ' . strlen($text));

//print $text;

//$regexp = '|<a href="(/film/([\d]+)/)" class="all">([^<>]*)(\([\d]{4}\))</a>|';

$regexp = '|<a href="/film/([\d]+)/" class="all">([^<]*)\(([\d]{4})\)</a><br />(?:<span class="text-grey">)|';

preg_match_all($regexp, $text, $matches);

 pr($matches);

$films = [];

foreach($matches[1] as $i => $id){
	$film = [];
	$film['id'] = $id;
	$film['name'] = $matches[2][$i];
	$film['year'] = $matches[3][$i];
	$films[] = $film;
}

function filmSort ($a, $b){
	if($a['year'] == $b['year'])
		return 0;
	return ($a['year'] < $b['year']) ? -1 : 1;
}

usort($films, 'filmSort');

// pr($films);

include 'kino_tpl.php';

