<?php

include 'core.php';

$logged = false;

if($_SESSION && isset($SESSION['user'])){
	include 'userlist.php';
} else {
	include 'login_form.php';
}
