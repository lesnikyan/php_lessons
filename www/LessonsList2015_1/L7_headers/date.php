<?php
include_once '../common.php';

$t1 = microtime(true);

p( "Now: " .  date("Y - m - d (l)") );

$time = strtotime("next day");
p("Next day: " . date("Y - m - d (l)", $time));

p("Prev month : " . date("Y - m - d (l)", strtotime("previous month")));

p("Minus date : " . date("Y - m - d (l)", -2000000000));

sleep(0.01);

$t2 = microtime(1);

p("process time = " . ($t2 - $t1));

