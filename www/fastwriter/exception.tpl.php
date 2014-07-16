<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Error!</title>
</head>
<body>
	<span style="color:#800"><?=$errorMsg?></span>
	<hr>
	<h4>Trace:</h4>
	<table>
	<?foreach($points as $point):?>
		<?foreach(array('file', 'line', 'function', 'args') as $key):?>
			<?if(isset($point[$key])):?>
				<tr>
					<td><?=$key?>: </td>
					<td style="font-weight: bold;">
						<?= ( (is_object($point[$key]) || is_array($point[$key])) ? json_encode($point[$key]) : $point[$key])?>
					</td>
				</tr>
			<?endif?>
		<?endforeach?>
		<tr>
			<td><hr></td><td><hr></td>
		</tr>
	<?endforeach?>
	</table>
</body>
</html>