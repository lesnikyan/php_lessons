<?php

function p($x="..."){
    print "<div>$x</div>\n";
}

function pa($x){
    print "<div>". implode(', ', $x) ."</div>\n" ;
}

class User {
    public $name; 
    function __construct($name){
        $this->name = $name;
    }
        
    public function __toString(){
        return $this->name;
    }
    
}

$compare = function($a1, $a2){
    if(strlen($a1->name) != strlen($a2->name)){
        return strlen($a1->name) > strlen($a2->name) ? 1 : -1;
    }
    return strcmp($a1->name, $a2->name);
};

$users = [new User("zzzzz"), new User("aaaa"), new User("eeee"), new User("rrrr"), new User("hhhh"), new User("ddd"), 
    new User("gggg"), new User("yyy"), new User("kk"), new User("pppp"), new User("qqq")];

usort($users, $compare);
pa($users);

//***********************

function decor($tag){
    $funcs = [
        'span' => function($x){ return "<span style='color:#aa8888;'>$x</span>"; },
        'div' => function($x){ return "<div style='border: 1px solid gray;'>$x</div>"; },
        'h1' => function($x){ return "<h1>$x</h1>"; },
        'bold' => function($x){ return "<span style='font-weight:bold;'>$x</span>"; }
    ];
    if(isset($funcs[$tag])){
        return $funcs[$tag];
    }
}

$div = decor('div');
p($div("Hello DIV!"));

$span = decor('span');
p($span("Hello SOME SPAN-Nya!"));

$bold = decor('bold');
p($bold("Hello SOME BRUTAL BOLD!"));

// ********************************





