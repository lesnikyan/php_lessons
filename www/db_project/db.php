<?php

class DB{
	private $host;
	private $login;
	private $pass;
	private $dbname;
	private $conn;
	
	function __construct($host, $login, $pass, $dbname){
		$this->host = $host;
		$this->login = $login;
		$this->pass = $pass;
		$this->dbname = $dbname;
		$this->conn = mysql_connect($this->host, $this->login, $this->pass);
		//p('db conn:');
		//p(gettype($this->conn));
		$this->selectDB($dbname);
	}
	
	function selectDB($dbname=null){
		if($dbname){
			$this->dbname = $dbname;
		}
		p("select db name = '{$this->dbname}'");
		$selected = mysql_select_db($this->dbname, $this->conn);
		if(! $selected){
			p("not selected DB");
		}
	}
	
	private $lastQueryResult = null;
	function query($sql){
		$this->lastQueryResult = mysql_query($sql, $this->conn);
		return $this;
	}
	
	function queryResult($obj = false){
		if(! $this->lastQueryResult){
			p($this->lastQueryResult);
			p('db error = ' .mysql_error());
		}
		if(! $this->lastQueryResult){
			return [];
		}
		$row;
		$res = [];
		while($row = mysql_fetch_assoc($this->lastQueryResult)){
			if($obj)
				$row = (object) $row;
			$res[] = $row;
		}
		return $res;
	}
	
	function lastId(){}
	
	function changed(){}

}