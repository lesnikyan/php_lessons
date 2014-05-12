<?php

/**
 * using:
 *  $model = Core::model('users');
 *  $info = $model->create(array('name'=>'Vasya', 'login'=>'vasya', 'pass'=>'123', 'email'=>'vasya@test.local'));
 */

class UsersModel extends Model{

	private $hashSalt = 'qwerty-salt!';

	function __construct(){
		parent::__construct('users');
	}

	function create($data){
		if(! $this->checkUnique($data['login'], $data['email'])){
			return array('success' => false, 'msg' => 'same user (login or email)) already created');
		}
		if(isset($data['id']))
			unset($data['id']);
		if(isset($data['pass'])){
			$data['pass'] = $this->hashPass($data['pass']);
		}
		$id = parent::create($data);
		return array('success' => true, 'id' => $id);
	}

	function checkUnique($login, $email){
		return (0 == count (
			$this->db->select("SELECT id FROM `{$this->table}` WHERE login = ? OR email = ?", array($login, $email ))
		));
	}

	function checkAuth($login, $pass){
		return (0 < count (
			$this->db->select("SELECT id FROM `{$this->table}` WHERE login = ? OR pass = ?", array($login, $this->hashPass($pass) ))
		));
	}

	function hashPass($pass){
		$res = hash_hmac('sha512', $pass, Core::conf('pass_hash_salt'));
		//p($res);
		return $res;
	}

}
