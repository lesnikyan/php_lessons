<?php
include 'prepare.php';
?><html>
<head>
	<script type="text/javascript" src="/jquery.js"></script>
	<script type="text/javascript" src="engine.js"></script>
	<link type="text/css" rel="stylesheet" href="reader.css" />
</head>
<body>
<div id=""menu>1 2 3 4 5</div>
<div id="content">...</div>
<div id="counter">0</div>
<div id="stat">0</div>
<select id="text-list">
	<?foreach($textList as $text):?>
	<option value="<?=$text?>"><?=$text?></option>
	<?endforeach;?>
</select>
<button id="load">load text</button><br />
<div>
	<textarea id="editor"></textarea>
	<button id="edit">set text</button>
</div>

<select id="speed">
	<?for($i=200; $i <= 1000; $i+=50):?>
		<option value="<?=($i)?>" <?if($i == 500):?>selected="selected"<?endif?>><?=($i)?></option>
	<?endfor;?>
</select> Speed (words per min)

</body>
</html>