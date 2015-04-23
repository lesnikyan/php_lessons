<?php
function p($x="..."){
    print "<div>$x</div>\n";
}
// ***************************
function textsize($size, $color){
    $fontSize = "font-size: {$size}px";
    $colorStyle = "color: $color";
    return function ($text) use ($fontSize, $colorStyle) {
        return "<span style='$fontSize; $colorStyle;'>$text</span>";
    };
}

$redNormal = textsize(20, 'red');
$greenGiant = textsize(50, 'green');
$girlText = textsize(25, '#ff44ee');

p($redNormal("normal text"));
p($greenGiant("Largest text of universe!!!"));
p($girlText('Nya!'));