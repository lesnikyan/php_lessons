<?php
function p($x){print "<div>$x</div>";}

function pr($x){
	print "<pre>\n"; print_r($x); print "</pre>\n";
}

include_once 'namespace.php';
include_once 'namespace2.php';

$user = new \Auth\User();
p($user->test());

$userData = new \Database\User();
pr($userData->data());

// ****************** multi NS *************** \\

include_once './multinamespace.php';

p("A:X::x = " . \A\X::$x);
p("B:X::x = " . \B\X::$y);

// ******** too many USE :) ********* \\

trait NoWoman {
	static function noCry(){
		return "no cry";
	}
}

use \Auth\User;

class Anonimus extends User {
	
	use NoWoman;
	
	function test($sentence = "anonimus dominatus"){
		$f = function($name) use ($sentence){
			return "$name, it's true: '$sentence'... but, " . self::noCry();
		};
		return $f;
	}
}

$anon = new Anonimus();
$oracle = $anon->test("homo homini lupus est");
p($oracle("Young padavan"));
