<?php

$colors = ['red', 'green', 'blue', 'yellow', 'gray'];

?><html>
	<head>
		<style>
			form>div{
				width: 500px;
				margin: 2px;
			}
			form>div>input{
				width: 300px;
				margin-left: 20px;
			}
			form>div>select{
				width: 380px;
				margin-left: 20px;
			}
			form>div>span.name{
				display:inline-block;
				width: 100px;
			}
			form>div>input[type="submit"]{
				width: 380px;
			}
		</style>
	</head>
	<body>
		<form action="handler.php" method="post">
			<div><span class="name">Login</span><input type="text" name="login" placeholder="Login" /></div>
			<div><span class="name">Email</span><input type="text" name="email" placeholder="Email" /></div>
			<div>
				<select name="color" >
					<?php foreach($colors as $color):?>
					<option value="<?=$color?>"><?=$color?></option>
					<?php endforeach?>
				</select>
			</div>
			<div><input type="submit" value="submit login" /></div>
		</form>
	</body>
</html>