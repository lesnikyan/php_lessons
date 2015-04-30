<?php

// Пример пригодного для SQL-инъекции кода.

$users = [];

if(!empty($_POST)){
	$msqli = mysqli_connect('localhost', 'root', '', 'test', 3306);
	$sql = "SELECT * FROM users WHERE login = '{$_POST['login']}' AND pass = '{$_POST['pass']}' ;";
	print $sql . "<br>\n";
	
	// запрос с инъекцией:
	// SELECT * FROM users WHERE login = '1' AND pass = '1' OR '1';
	// изменение запроса инъекцией: 
	// [pass = ''];  ->  [pass = '1' OR '1'];  
	// ввод: [1' OR '1]

	$result = $msqli->query($sql);
	print "{$result->num_rows}<br>\n";

	if ($result AND $result->num_rows > 0){
		$users = $result->fetch_all(MYSQLI_ASSOC);
	}
}
?>
<html>
<head>
	<style>
		div.user{
			margin: 5px;
			border: 1px solid #eee;
		}
		div.user div {
			margin: 2px;
		}
	</style>
</head>
<body>
	<form action="" method="post"> 
		<input type="" name="login"> Login
		<input type="" name="pass">Password
		<input type="submit" value="log in">
	</form>
	<?if(! empty($users)):?>
		<?foreach($users as $i => $u):?>
		<div class="user">
			<div>Name: <?=$u['name']?></div>
			<div>Login: <?=$u['login']?></div>
			<div>Password: <?=$u['pass']?></div>
			<div>Email: <?=$u['email']?></div>
		</div>
		<?endforeach?>
	<?endif?>
</body>
</html>