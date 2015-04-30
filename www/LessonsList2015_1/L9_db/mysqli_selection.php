<?php
include 'connect.php';
//*********************** DELETING  

if(isset($_GET['del_id'])){
	$delId = intval($_GET['del_id']);
	$sqlDel = "DELETE FROM `users` WHERE `id` = $delId ";
	$db->query($sqlDel);
}
// ********************** SELECTING
$sqlSelectAll = "SELECT * FROM `users` LIMIT 0, 10";

// get query result
$result = $db->query($sqlSelectAll);

if ($result){
	p("Selected rows: " . $result->num_rows);
	
	// get all rows from result object
	$rows = $result->fetch_all(MYSQLI_ASSOC);
	
	//pr($rows);
	
	$html = "<table border=1>\n"
			. "<tr><td>Name</td>"
			. "<td>Login</td>"
			. "<td>Email</td>"
			. "<td>Age</td>"
			. "<td>Gender</td>"
			. "<td>Operations</td></tr>";
	foreach($rows as $i => $row){
		// show each row 
		$bgstyle = "background-color: " . ($row['gender'] == 'female' 
				?  '#ffaaff' : '#afafaf');
		$html .= "<tr>"
				. "<td style='$bgstyle;'>{$row['name']}</td>"
				. "<td style='$bgstyle;'>{$row['login']}</td>"
				. "<td style='$bgstyle;'>{$row['email']}</td>"
				. "<td style='$bgstyle;'>{$row['age']}</td>"
				. "<td style='$bgstyle;'>{$row['gender']}</td>"
				. "<td><a href='?del_id={$row['id']}'>DELETE</a></td>"
				. "</tr>\n";
	}
	$html .= "</table>\n";
	
	// close  result resource
	$result->close();
}

// close connection
$db->close();

print <<<STYLE
<style type="text/css">
	table, table tr td {
		border: 1px solid silver;
   }
</style>
STYLE;
print "<div>$html</div>";
include 'insert_form.php';