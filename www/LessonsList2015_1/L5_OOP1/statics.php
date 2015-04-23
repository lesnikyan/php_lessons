<?php

require_once '../common.php';

class Colors {
	
	const Red = "#ff0000";
	const Green = "#00ff00";
	const Blue = "#0000ff";
	const Black = "#000000";
	
	static function rgb($r, $g, $b){
		return "rgb($r, $g, $b)";
	}
}


class Html {
	
	static function tag($name, $content, $color=null){
		$colorStr = "gray";
		if(is_null($color )){
			$colorStr = Colors::Black;
		} elseif(is_array($color)){
			$colorStr = Colors::rgb($color[0],$color[1],$color[2]);
		} elseif(is_string($color)) {
			$colorStr = $color;
		}
		return "<$name style='color: $colorStr;'>$content</$name>";
	}
	
	static function span($content, $color=null){
		return self::tag('span', $content, $color);
	}
}


p(Html::tag('span', 'Hello span', [255, 125, 0]));
p(Html::span('Hello span', [0, 125, 0]));
p(Html::span('Hello Red', Colors::Red));
