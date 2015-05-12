<?php

function pc($x){
  print "$x\n";
}

function ph($x){
	return pc("<div>$x</div>");
}

function p($x){ return ph($x);}

class T{
  function __construct($x, $y=null, $f=null){
    if(is_array($x)){
		$data = $x;
		$x = $data['x'];
		$y = $data['y'];
		$f = isset($data['f']) ? $data['f'] : null;
	}
	$this->_init($x, $y, $f);
  }
  
  private function _init($x, $y, $f){
	p("T($x, $y)");
	if($f != null){
		$f($this);
	}
  }
  
   function __get($key){
    switch($key){
      case 'elem': return $this;
        break;
    }
  }
  
  function add($z){
    p("(z=$z)");
  }
  
  function call($f){
	$f($this);
	return $this;
  }
  
  static function T($x, $y=null, $f=null){
	return new T($x, $y, $f);
  }
  
}

// ************************* getter
$t = new T(1, 2);
$t->add('333');
(new T('a', 'b'))->elem->add('cde');

//************************** lambda
 new T('a2', 'b2', function(T $obj){ $obj->add('cde2'); });

// ************************* array

new T(['x'=>'a3', 'y'=>'b3', 'f'=>function(T $obj){ $obj->add('cde3'); } ]);
// ************************* static

T::T('a4', 'b4', function(T $obj){ $obj->add('cde4'); });

T::T('a5', 'b5')->add('cde5');

T::T('a6', 'b6', function(T $obj){ $obj->add('ccc1'); })
	->call(function(T $obj){ $obj->add('ccc2'); })
	->call(function(T $obj){ $obj->add('ccc3'); })
	->call(function(T $obj){ $obj->add('ccc4'); });
