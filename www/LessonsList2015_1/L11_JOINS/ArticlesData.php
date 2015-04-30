<?php
include_once 'CommonData.php';

class ArticlesData extends CommonData {
	
	function __construct(){
		parent::__construct('articles');
	}
	
	function add($data){
		$fields = '';
		$values = '';
		foreach($data as $field => $val){
			$fields .= "`$field`, ";
			$values .= "?, ";
		}
		$fields .= "`date_created`";
		$values .= "CURRENT_TIMESTAMP";
		$sql = "INSERT INTO `articles` ($fields) VALUES ($values);";
		$requestData = array_values($data);
		return $this->db->insert($sql, $requestData);
	}
	
	function all($offset=0, $limit=100){
		$sql = "SELECT u.id as uid, u.name, 
a.id  as aid, a.title, a.content, a.date_created as `date`
FROM users u
INNER JOIN articles a ON a.user_id = u.id";
		return $this->db->select($sql);
	}
	
}