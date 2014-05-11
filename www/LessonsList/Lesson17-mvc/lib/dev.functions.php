<?php

function p($x, $typeFlag = 0){
	$type = gettype($x);
	if($typeFlag)
		print "type: $type :<br>\n";
	$ptext = $x;
	if ($type == 'boolean')
		$ptext = $x ? 'TRUE' : 'FALSE';
	if (! in_array($type, array('array', 'object')))
		print "<div>$ptext</div>\n";
	else {
		print "<pre>"; print_r($x); print "</pre>\n";
	}
}

function html_table($data, $style=array()){
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