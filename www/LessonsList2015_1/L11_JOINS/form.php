<html>
	<head>
		<style type="text/css">
			textarea[name="content"]{
				width: 400px;
				height: 300px;
			}
			form>div{
				width:402px;
				margin-top: 2px;
			}
			form>div>input{
				width: 100%;
				
			}
		</style>
	</head>
	<body>
		<h3>Create new article</h3>
		<form action="create.php" method="post">
			<div><input type="text" name="title" placeholder="Title" /></div>
			<div><textarea name="content"></textarea></div>
			<div><input type="submit" value="create" /></div>
		</form>
	</body>
</html>