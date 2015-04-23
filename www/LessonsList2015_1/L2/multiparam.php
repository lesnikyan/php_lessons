<?php


function p($x="..."){
    print "<div>$x</div>\n";
}

function pa($x){
    print "<div>". implode(', ', $x) ."</div>\n" ;
}
// *************************************************

function multiPulty(){
    $params = func_get_args();
    $html = "<table border=1><tr>";
    $num = func_num_args();
    $html .= "<td>num: $num</td>";
    foreach($params as $param){
        $html .= "<td>$param</td>";
    }
    $html .= "</table>";
    return $html;
}


$res = multiPulty('Lorem', 'ipsum', 'dolor', 'sit', 'amet', 'consectetur', 'qwerty1', 'qwerty2', 'qwerty3');
p($res);
