<?php


class MysqlDriver extends PDO{

	private $lastQueryStatus = false;

	function query($sql, $params = array()){
		$stat = $this->prepare($sql); // get PdoStatement object
		$this->lastQueryStatus = $stat->execute($params);
		return $stat; // ->fetchAll(PDO::FETCH_CLASS);
	}
	
	function select($sql, $params = array()){
		$res = $this->query($sql, $params);
		if($this->lastQueryStatus)
			return $res->fetchAll(PDO::FETCH_CLASS); // method from PdoStatement
		return [];
	}
	
	function insert($sql, $params = array()){
		$res = $this->query($sql, $params);
		if($this->lastQueryStatus){
			return $this->lastInsertId(); // method from PDO
		}
		return null;
	}
	
	function update($sql, $params = array()){
		$res = $this->query($sql, $params);
		if($this->lastQueryStatus)
			return $res->rowCount(); // method from PdoStatement
		return 0;
	}
	
	function delete($sql, $params = array()){
		return $this->update($sql, $params);
	}
	
	function parent_query($a, $b=null, $c=null){
		return parent::query($a, $b, $c);
	}
}


/*	
$db = new MyDB('mysql:dbname=db_lessons;host=localhost', 'root', '');
$data = $db->query("SELECT * FROM users WHERE login = :login ", 
	[':login' => $_GET['login']]);

*/
