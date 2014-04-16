<?php

// preg_match(); // perl
//ereg_match();  // posix

// модификаторы:
// http://ua1.php.net/manual/ru/reference.pcre.pattern.modifiers.php

// синтаксис:
// http://ua1.php.net/manual/ru/reference.pcre.pattern.syntax.php

$str = 'Hello world!';

if(preg_match('|hello|iU', $str)){
	print "TRUE helloworld!";
} else {
	print "incorrect string by noobs :(";
}
print'<br>';
$text = <<<ET
<dt>Keyboard Shortcuts</dt><dt>?</dt>
<dd>This help</dd>
<dt>j</dt>
<dd>Next menu item</dd>
<dt>k</dt>
<dd>Previous menu item</dd>
<dt>g p</dt>
<dd>Previous man page</dd>
<dt>g n</dt>
<dd>Next man page</dd>
<dt>G</dt>
<dd>Scroll to bottom</dd>
<dt>g g</dt>
<dd>Scroll to top</dd>
<dt>g h</dt>
<dd>Goto homepage</dd>
<dt>g s</dt>
ET;
preg_match_all('|<[td]*>|iU', $text, $matches);

$out = "<pre>". htmlspecialchars(print_r($matches, 1)) . "</pre>";
print $out;

