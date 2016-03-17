<?php

include './html_factory.php';

use \HtmlFactory\h;
use \HtmlFactory\ContainerTag;
use \HtmlFactory\TableRow;
use \HtmlFactory\StyleTag;

$page = new h();

$table1 = $page->table([], ['class' => 'test1']);
for($i=1; $i<=5; ++$i){
	$tr = new TableRow(null,null,1);
	for($j=1; $j<=4;++$j){
		$tr->addNode(new ContainerTag('td', "TD Node $i-$j", [], false));
	}
	$table1->addNode($tr);
}
$body = $page->tag('body', null, null, true);
$head = $page->tag('head', null, null, true);
$html = $page->tag('html', null, null, true);

$style = $page->tag('style', "
	table.test1 {
		border: 1px solid red;
		color: #888;
	}
	table.test1 tr td {
		border: 1px solid red;
		color: #888;
	}
	
	div#sdiv{
		background-color: #40a;
		color: #ff8;
	}
	
	");
$head->addNode($style);
$div1 = $page->div();
$div1->addNode($table1);
$body->addNode($div1);
$body->addNode($page->tag('br'));
$body->addNode($page->div("Second div.", ['id' => 'sdiv']));

$span2 = $page->span('span tag 2', ['class' => 'sp2']);
$span3 = $page->span('span tag 3', ['class' => 'sp3']);
$div2 = $page->div('', ['class' => 'ts2']);
$style2 = new StyleTag([
	'div.ts2' => [
		'color'			=> '#800',
		'font-weight'	=> 'bold',
		'border'		=> '1px solid green',
		'width'			=> '400px',
		'border-radius' => '4px'
	],
	'span.sp2' => [
		'color' => '#044'
	]
]);

$div2->addNode($span2);
$div2->addNode($span3);
$body->addNode($div2);
$head->addNode($style2);

$html->addNode($head);
$html->addNode($body);

//print $html->render();
print $html;