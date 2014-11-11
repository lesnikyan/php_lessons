<?php
header('Content-Type: text/html; charset=utf-8');

function br($num=1){
	return "\n" . str_repeat("<br>\n", $num);
}

function p($x='print empty...'){
	$type = gettype($x);
	$out = $x;
	if(in_array($type, array('object', 'array'))){
		$out = "<pre>\n". print_r($x, 1) . "\n</pre>";
	} elseif($type == 'boolean'){
		$out = $x ? 'TRUE' : 'FALSE';
	}
	print "<div>($type) $out</div>";
}


function pr(){
	print "<div><pre>";
	print_r($var);
	print "</pre></div>";
}

function vd($var){
	print "<div><pre>";
	var_dump($var);
	print "</pre></div>";
}


function html_table($data, $style=''){
	if(empty($data)){
		return null;
	}
	$row1 = $data[0];
	$keys = array_keys(is_array($row1) ? $row1 : get_object_vars($row1));
	
	function val($obj, $field){
		if(is_object($obj)) return $obj->{$field};
		elseif(is_array($obj)) return $obj[$field];
		return null;
	}
	
	$tabStyle = "";
	$tdStyle = "";
	if(is_string($style)){
		$tabStyle = $style;
		$tdStyle = $style;
	} else {
		if(isset($style['table']))
			$tabStyle = $style['table'];
		if(isset($style['td']))
			$tdStyle = $style['td'];
	}
	$tabStyle = "style=\"".$tabStyle."\"";
	$tdStyle = "style=\"".$tdStyle."\"";
	
	$html = "<table $tabStyle>\n";
	$html .= "<tr>\n";
	foreach($keys as $key){
		$html .= "<th>$key</th>\n";
	}
	$html .= "</tr>\n";
	
	foreach($data as $i => $unit){
		$html .= "<tr>\n";
		foreach($keys as $key){
			$val = val($unit, $key);
			$html .= "<td $tdStyle>{$val}</td>\n";
		}
		$html .= "</tr>\n";
	}
	
	$html .= "</table>";
	return $html;
}


function html_table_old($data, $style=''){
	if(! is_array($style)){
		$style=array('table' => $style);
	}
	
	if(empty($data) || !isset($data[0])){
		return null;
	}
	
	$keys = array_keys($data[0]);
	
	$tbstyle = isset($style['table']) ? "style='{$style['table']}'" : '';
	$htrstyle = isset($style['htr']) ? "style='{$style['htr']}'" : '';
	$thstyle = isset($style['th']) ? "style='{$style['th']}'" : '';
	$trstyle = isset($style['tr']) ? "style='{$style['tr']}'" : '';
	$tdstyle = isset($style['td']) ? "style='{$style['td']}'" : '';
	
	$head = "\t<tr>\n";
	foreach($keys as $name){
		$ucname = ucfirst($name);
		$head .= "\t\t<th $thstyle>$ucname</th>\n";
	}
	$head .= "\t</tr>\n";
	
	$body = "";
	foreach($data as $row){
		$tr = "\t<tr $trstyle>\n";
		foreach($row as $key => $val){
			if(! $val)
				$val = '-- &nbsp;';
			$tr .= "\t\t<td $tdstyle>$val</td>\n";
		}
		$tr .= "\t</tr>\n";
		$body .= $tr;
	}
	$body .= "";
	return "\n<table $tbstyle>\n{$head}{$body}</table>\n";
}
