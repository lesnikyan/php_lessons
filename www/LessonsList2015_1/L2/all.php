<?php
function p($x="..."){
    print "<div>$x</div>\n";
}

$all = get_defined_functions();

/*
print "<pre>";
print_r($all);
var_dump($all);
*/
print "</pre>";
foreach($all as $funcs){
    foreach ($funcs as $func){
    p($func);    
    }
}