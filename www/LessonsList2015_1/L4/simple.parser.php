<?php
include '../common.php';

header('Content-Type: text/html; charset=utf-8');

$text = file_get_contents('data.txt');
$text = str_replace('&nbsp;', ' ' , $text);

$alph = 'абвгдеёжзиклмнопрстуфхцчшщъыьэюя';
$alph .= mb_strtoupper($alph);
//p($text);
//p($alph);   // [^<>]
$regex = '#<tr>\s*<td>\s*([\d]+)</td>\s*<td>\s*(['. $alph .'0-9,.\-!? ]+)</td>\s*<td>\s*([\d]+)</td>\s*</tr>#Umi';
//p($regex);

$regex = '#<tr>\s*<td>(\d+)</td>\s*<td>([^<>]+)</td>\s*<td>(\d*)</td>#iUm';

if(! preg_match_all($regex, $text, $matches)){
    print "No result found!";
    exit;
}

// pr($matches); exit;

$list = [];

foreach($matches[0] as $i => $val){
   $list[] = [
       'id' => $matches[1][$i],
       'name'   => "{$matches[2][$i]} ({$matches[3][$i]})"
   ];
}

$html = '';
foreach($list as $item){
    $link = "<div style='border: 1px solid #808080; border-radius: 5px; margin: 5px; padding: 1px 0 1px 10px;'>"
            . "<a style='text-decoration: none; color: #800;' href='kino.php?id={$item['id']}'>{$item['name']}</a></div>\n";
    $html .= $link;
}

print $html;
