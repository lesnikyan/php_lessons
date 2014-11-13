<?php

require_once '../common.php';

// windows commands: http://ab57.ru/cmdlist.html

//exec('findstr /S /M "<?php" ..\..\..\*.*', $result);
//exec('findstr /S /M "function" ..\..\..\*.js', $result);
exec('findstr /S /M "class" ..\..\..\*.*', $result);

foreach($result as $row){
	print "<div>$row</div>";
}
