<?php
function p($x){print "<div>$x</div>";}

$time1 = microtime(true);

p($time1);
//time
p(time());

//date
p(date('Y - m - d / H : i : s', time()));

// str to time

sleep(0);
$dateStr = date('d F Y H:i:s');
$time = strtotime($dateStr);
p($dateStr ); // 01 April 2014 20:08:16
p(date('Y - m - d / H : i : s' , $time));


$time2 = microtime(true);
$timeDiff = $time2 - $time1;
p("time of work = $timeDiff sec");

