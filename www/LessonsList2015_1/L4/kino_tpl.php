<html>
<head>
</head>
<body>
	<h3>Топ кино</h3>
	<table>
		<tr>
			<th>Индекс</th>
			<th>Название</th>
			<th>Год выхода</th>
		</tr>
		<?foreach($films as $kino):?>
		<tr>
			<td><?=$kino['id']?></td>
			<td><?=$kino['name']?></td>
			<td><?=$kino['year']?></td>
		</tr>
		<?endforeach?>
	</table>
</body>
</html>