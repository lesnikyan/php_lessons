<?php

// phpinfo();


class ZeroDivException extends Exception{
	
}

function statistic($num, $val){
		if($num==0)
			throw new ZeroDivException();
		if($num < 0)
			throw new Exception('number less then 0');
		print ($val / $num);

}

class Service {
	function run(){	
		$num = $_GET['number'];
		$val = $_GET['value'];
		statistic($num, $val);
	}
}

function foo(){
	try{
		$service = new Service();
		$service->run();
	} catch(ZeroDivException $e){
		print "number = 0";
		$trace = $e->getTrace();
		print "<pre>"; print_r($trace);
	} catch(Exception $e){
		print $e->getMessage();
	} 
}

foo();

/*finally {
	print "Я ж вам казала!!";
}*/

