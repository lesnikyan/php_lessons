<?php

include_once 'ArticlesData.php';

function redirect($url='http://test1.com:81/group3/L11_JOINS/form.php'){
	header('location:' . $url);
}

if(empty($_POST) || !isset($_POST['title']) || !isset($_POST['content'])){
	redirect();
}

$userId = 2; // hardcoded id of current user
$insertData = [
	'title' => $_POST['title'],
	'content' => $_POST['content'],
	'user_id' => $userId,
];

$artData = new ArticlesData();
$artId = $artData->add($insertData);

redirect('http://test1.com:81/group3/L11_JOINS/articles.php');
