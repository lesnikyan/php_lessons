<?php

include_once 'db.php';

class UserDB extends DB{
	function __construct(){
		parent::__construct('users');
	}
	
	/**
	* $fields - null
	* $fields - string 'fieldName'
	* $fields - array('field1', 'field2', ...)
	*/
	function getAll($fields=null){	
		if($fields !== null){
			if(! is_array($fields)){
				$fields = array($fields);
				$fieldStr = '`' . implode('`,`', $fields) . '`' ;
			}
		} else {
			$fieldStr = '*';
		}
		return $this->driver->select("SELECT $fieldStr FROM `{$this->table}`;");
	}
	
	function getByLogin($login){
		return $this->driver->select("SELECT * FROM `{$this->table}` WHERE login = ?", 
			[$login]);
	}
	
	function checkUser($login, $pass){
		$res = $this->driver->select(
			"SELECT id FROM `{$this->table}` WHERE `login` = ? AND `pass` = ?", 
			[$login, $pass]);
		return count ($res) > 0;
	}
	
}