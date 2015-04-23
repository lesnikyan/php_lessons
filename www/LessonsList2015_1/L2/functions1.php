<?php

function p($x="..."){
    print "<div>$x</div>\n";
}

function pa($x){
    print "<div>". implode(', ', $x) ."</div>\n" ;
}

function sum($a1, $a2){
    return $a1 + $a2;
}

function pow2($x, $y){
    $res = 1;
    for($i=0; $i<$y; ++$i){
        $res *= $x;
    }
    return $res;
}

function pow3($x, $y){
    if($y > 0)
        return $x * pow3($x, $y-1);
    else
        return 1;
}

function pow4($x, $y){
    return $y > 0 ? $x * pow4($x, $y - 1) : 1;
}

$res = sum(12, 13);

p($res);

// ********************************

p(pow2(2, 10));
p(pow3(2, 10));
p(pow4(2, 10));

//*********************************

p();

//*********************************

class Aa {
    public $b;
}

function c($x){
    $x->b = "CCC";
}

$a = new Aa();
$a->b = "BBB";
c($a);
p($a->b);

$arr1 = [1];
$arr2 = &$arr1;
$arr2[] = 2;
p(implode(', ', $arr1));

function changeArray(&$a){
    $len = count($a);
    for($i=0; $i<$len; ++$i){
        $a[] = $a[$i] * 10;
    }
}

$ar1 = [1,2,3,4,5];
changeArray($ar1);
pa($ar1);

//isset($a);
unset($ar1[6]);
pa($ar1);

//***************************

function prettyCounter(){
    static $counter = 0;
    $counter ++;
    return $counter;
}

for($i=0; $i<10; ++$i){
    p(prettyCounter());
}

// ***************************





