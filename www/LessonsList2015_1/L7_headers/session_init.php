<?php

// $_SESSION;
session_start();

include 'session_menu.php';

$_SESSION['lastTime'] = time();

if(! empty($_POST) && isset($_POST['data'])){
	$_SESSION['userData'] = $_POST['data'];
	header("location:http://test1.com:81/group3/L7_headers/session_test.php");
}

?>
<form action="" method="post">
	<input type="text" name="data" />
	<input type="submit" value="send" />
</form>
<?


