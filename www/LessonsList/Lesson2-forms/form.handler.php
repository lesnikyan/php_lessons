<?php

$fname = $_POST['fname'];

print "<div style=\"font-weight:bold; color: #0088ff\">$fname</div>";

print '<pre>';
print_r($_POST);
print '</pre>';
?>
<table>
	<tr>
		<td><?php print $fname ?></td>
	</tr>
</table>