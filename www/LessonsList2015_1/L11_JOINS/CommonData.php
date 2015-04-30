<?php
include_once 'ExtPDO.php';

class CommonData {
	
	protected $table;
	protected $db = null;
	
	public function __construct($table){
		$this->table = $table;
		$this->db = new ExtPDO('mysql:dbname=php3_test1;host=localhost', 'root', '');
	}
	
	public function create($data){
		$fields = array_keys($data);
		$fStr = '';
		foreach($fields as $field){
			$fStr .= "`$fild`, ";
		}
		$fStr = substr($fStr, 0, -2);
		
		$values = array_values($data);
		$vStr = array_fill(0, count($values), '?, ');
		$vStr = substr($vStr, 0, -2);
		
		$sql = "INSERT INTO `{$this->table}` ($fStr) VALUES ($vStr); ";
		
		return $this->db->insert($sql, $values);
		
	}
	
}