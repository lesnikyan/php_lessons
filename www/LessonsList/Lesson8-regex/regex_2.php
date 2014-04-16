<?php


$text = <<<QWE
<a href="1231">QWERTY1</a>
<a href="1232">QWERTY2</a>
<a href="1233">QWERTY3</a>
<a href="1234">QWERTY4</a>
<a href="1235">QWERTY5</a>
QWE;


$newText = preg_replace('|<a href="([^>]+)">|', '<a href="/my_site/banners/${1}"><br>', $text);

print $newText;