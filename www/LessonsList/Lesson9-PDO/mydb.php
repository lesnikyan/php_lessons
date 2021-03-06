<?php

class MyDB extends PDO{

	private $lastQueryStatus = false;

	function query($sql, $params = array()){
	//	p($sql);
	//	pr($params);
		$stat = $this->prepare($sql); // get PdoStatement object
		$this->lastQueryStatus = $stat->execute($params);
		return $stat; // ->fetchAll(PDO::FETCH_CLASS);
	//	return $stat->fetchAll(PDO::FETCH_ASSOC);
	//	return $stat->fetchAll(PDO::FETCH_BOTH);
	}
	
/*	
$db = new MyDB('mysql:dbname=db_lessons;host=localhost', 'root', '');
$data = $db->query("SELECT * FROM users WHERE login = :login ", [':login' => $_GET['login']]);
	
*/

	function select($sql, $params = array()){
		$res = $this->query($sql, $params);
		if($this->lastQueryStatus)
			return $res->fetchAll(PDO::FETCH_CLASS); // method from PdoStatement
		return [];
	}
	
	function update($sql, $params = array()){
		$res = $this->query($sql, $params);
		if($this->lastQueryStatus)
			return $res->rowCount(); // method from PdoStatement
		return 0;
	}
	
	function insert($sql, $params = array()){
		$res = $this->query($sql, $params);
		if($this->lastQueryStatus){
			return $this->lastInsertId(); // method from PDO
		}
		return null;
	}
	
	function parent_query($a, $b=null, $c=null){
		return parent::query($a, $b, $c);
	}
	
	
	
}