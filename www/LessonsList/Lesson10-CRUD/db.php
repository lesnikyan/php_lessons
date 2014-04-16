<?php

// CRUD

include_once 'mysql_drv.php';

class DB {
	
	protected $driver = null;
	
	protected $table;
//	private $field = [];
	
	function __construct($table){
		$this->table = $table;
		$this->driver = new MysqlDriver('mysql:dbname=db_lessons;host=localhost', 'root', '');
	}
	
	// [name => Vasya, age => 25]
	function create($data){
		$keys = array_keys($data);
		$fields = "`".implode("`,`", $keys)."`" ; // `name`,`age`
		$values = substr(str_repeat('?,', count($keys)), 0, -1) ; // ?, ?
		$sql = "INSERT INTO `{$this->table}` ({$fields}) VALUES ({$values}); ";
		$sqlData = array_values($data);
		return $this->driver->insert($sql, $sqlData);
	}
	
	// 1
	function read($id){
		$sql = "SELECT * FROM `{$this->table}` WHERE `id` = ?; ";
		return $this->driver->select($sql, array($id));
	}
	
	function update($id, $data){
		// UPDATE {table} SET field1 = ?, field2 = ?
		$fields = '';
		$sqlData = [];
		foreach($data as $key => $val){
			$fields = "`{$key}` = ?,";
			$sqlData[] = $val;
		}
		$fields = substr($fields, 0 , -1);
		
		$sql = "UPDATE `{$this->table}` SET $fields WHERE `id` = ?";
		$sqlData[] = $id;
		p($sql);
		pr($sqlData);
		//return;
		return $this->driver->update($sql, $sqlData);
	}
	
	function delete($id){
		$sql = "DELETE FROM `{$this->table}` WHERE `id` = ? ";
		return $this->driver->delete($sql, [$id]);
	}
	
	function parent(){
		return $this->driver;
	}
}