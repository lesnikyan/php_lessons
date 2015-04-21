<?php

include '../common.php';
require_once 'Routing.php';

//preg_match('#^/([a-z]+)/([a-z]+)/([0-9]+)#', '/qwe/rty/123', $m);
//p($m);

$r1 = new RoutingRegexRule('#/manual-page/(.+)/(.+)/(.+)#', ['controller' => 'manual_page_2', 'method' => 1, 'param1' =>2, 'param2' => 3]);
$rout = $r1->getRouting('/manual-page/action2/aaaa/1111');
//print_r($rout);
p('');
$rt = new Routing();

$rt->add(new RoutingRegexRule('#^/([^/]+).html$#', 
	['controller' => 'goods', 'method' => 'view', 'param1' =>1]));
$rt->add(new RoutingRegexRule('#^/admin/panel/([^/]+)/([^/]+)/([^/]+)/([^/]+)#', 
	['controller' => 'adminPanel', 'method' => 1, 'param1' =>2, 'param1' =>3, 'param1' =>4]));
$rt->add(new RoutingRegexRule('#^/([^/]+)/([^/]+)/([^/]+)$#', 
	['controller' => 'commonOneParam', 'method' => 1, 'param1' =>2]));
$rt->add(new RoutingRegexRule('#^/service/([^/])/([^/])/([^/])#Ui', 
	['c'=>'remoteService', 'm'=> 1, 'p1'=>2, 'p2'=>3]));
$rt->add(new RoutingRegexRule('#^/manual-page/(.+)/(.+)/(.+)#', 
	['controller' => 'manual_page_2', 'method' => 1, 'param1' =>2, 'param2' => 3]));
$rt->add(new RoutingRegexRule('#^/(service[^/?]+)(?:/([^/?]+))?(?:/([^/?]+))?(?:/([^/?]+))?(?:/([^/?]+))?(?:/([^/?]+))?#', 
	['controller' => 1, 'method' => 2, 'p1' =>3, 'p2' => 4, 'p3' => 5, 'p4' => 6]));

$def = new DefaultRoutingRule();
//print_r($def->getRouting('/contr/act/123/444/555/67890'));

p($rt->find('/qqq/www/eee/1111')->getRouting());
p($rt->find('/erricson-mobile-550i.html')->getRouting());
p($rt->find('/manual-page/action2/aaaa/1111')->getRouting());
p($rt->find('/service/reports/daily/today/id0012')->getRouting());
p($rt->find('/service2/reports2/daily/today/123')->getRouting());


