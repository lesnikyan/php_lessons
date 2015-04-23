<?php

include_once '../common.php';

define('TEXT_DIR', __DIR__ . '/text_files');

$file = (isset($_GET['file']) && !empty($_GET['file'])) ? $_GET['file'] : null;

$files = scandir(TEXT_DIR);


foreach($files as $i => $f){
	if(! is_file(TEXT_DIR. '/'. $f)){
		unset($files[$i]);
	}
}
//p('file = ' . $file);
$files = array_values($files);
//pr($files);
if( ( is_null($file) || !file_exists(TEXT_DIR . '/'. $file) ) && count($files) > 0){
	$file = $files[0];
}

$filePath = TEXT_DIR . '/'. $file;
$content = '';

if(!empty($files) && file_exists($filePath) && is_file($filePath)){
	$content = file_get_contents($filePath);
}

?>
<html>
	<head>
		<style type="text/css">
			div#menu{
				width:200px;
				border: 1px solid #aaa;
				min-height: 600px;
				margin: 4px;
				float: left;
			}
			div#content{
				width:800px;
				border: 1px solid #aaa;
				min-height: 600px;
				margin: 4px;
				float: left;
			}
			div#content>div>form>div{
				margin: 4px;
			}
			div#content>div>form>div>textarea{
				width: 780px;
				height: 540px;
			}
			input[name="filename"]{
				width: 780px;
			}
			div#menu>a{
				display: block;
				text-decoration: none;
				background-color: #aaa;
				border-radius: 4px;
				padding: 0 5px 0 5px;
				margin: 1px 0 0 0;
			}
			div.clear{
				clear:both;
			}
		</style>
	</head>
	<body>
		<h3>Super fast and useful Online Text editor!</h3>
		<div id="menu">
			<?php foreach($files as $f):?>
			<a href="texts.php?file=<?=$f?>"><?=$f?></a>
			<?php endforeach;?>
		</div>
		<div id="content">
			<div>
				<form action="save.php" method="post" >
					<div><input type="text" name="filename" value="<?=$file?>" /></div>
					<div><textarea name="text"><?=$content?></textarea><div>
					<div><input type="submit" value="save" /></div>
				</form>
			</div>
		</div>
	<div class="clear"></div>
						
	</body>
</html>