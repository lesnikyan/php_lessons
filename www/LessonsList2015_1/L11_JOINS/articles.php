<?php

include_once 'ArticlesData.php';

$dataModel = new ArticlesData();

$list = $dataModel->all();

?>
<html>
	<head>
		<style type="text/css">
			h3{
				color: #400;
				margin-left: 200px;
			}
			h3>a{
				text-decoration: none;
				color: #88a;
			}
			div.article{
				border: 1px solid silver;
				width: 800px;
				padding: 5px;
				margin: 5px;
				border-radius: 5px;
			}
			div.title{
				font-weight: bold;
				font-size: 1.2em;
				color: #888;
			}
			div.content{
				color: #444;
			}
		</style>
	</head>
	<body>
		<h3>Articles <a href="form.php">add new</a></h3>
		<?php foreach($list as $article):?>
		<div class="article">
			<div class="title"><?=$article->title?></div>
			<div class="content"><?=$article->content?></div>
		</div>
		<?php endforeach;?>
	</body>
</html>
