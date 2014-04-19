<?php 
include '../common.php';

$zipFile = 'zipped/content.zip';
$zipPath = 'content/';

$zip = new ZipArchive;

if(!$zip->open($zipFile)){
	die('Unable open file!');
}

// read archive
$num = $zip->numFiles;

$files = [];
$schemaIndex = null;
$fileExt = ['txt', 'png', 'jpg', 'jpeg']; // accessible extensions
// $i from 1, $i=0 - root dir
for($i=1; $i<$num; ++$i){
	$stat = $zip->statIndex($i);
	//p($stat);
	$name = $stat['name'];
	if(preg_match('|^content/[\w]+\.([\w]+)$|', $name, $match)){
		//p($stat['name']);
		if($match[1] == 'xml'){
			$schemaIndex = $i;
		}
	} elseif (in_array($match[1], $fileExt)){
		$files[] = $name;
	}
}

// ************* XML Schema of data ***************
if(! $schemaIndex){
	die('No valid schwma');
}

$schemaData = $zip->getFromIndex($schemaIndex);
//p(htmlspecialchars($schemaData));

$xml = simplexml_load_string($schemaData);

$nodes = $xml->xpath('/nodes/node');

$units = xml2array($nodes, ['text', 'image', 'title']);

// Methods
function xml2array( $xmlNodes, $fields ){
	$res = [];
	foreach($xmlNodes as $node){
		$elem = [];
		$attr = $node->attributes();
		foreach($fields as $field){
			$elem[$field] = (string) $attr->{$field};
		}
		$res[] = $elem;
	}
	return $res;
}

function img2base64($image){
	ob_start();
	imagepng($image);
	$data = ob_get_contents();
	ob_end_clean();
	$data64 = base64_encode($data);
	return $data64;
}

// Prepare data
// make image
$nodeIndex = isset($_GET['page']) ? intval($_GET['page']) : 0 ;
$imagePath = "$zipPath{$units[$nodeIndex]['image']}";

$imageStr = $zip->getFromName($imagePath);

$image = imagecreatefromstring($imageStr);
$imageData = 'data:image/png;base64,' . img2base64($image);

// make text
$textPath = "$zipPath{$units[$nodeIndex]['text']}";
$textStr = $zip->getFromName($textPath);
$textStr = str_replace("\n", "<br />\n", $textStr);

?>
<h3>Анекдоты</h3>
<div style="width:600px;border:1px solid silver; padding: 20px; margin: 20px;">
<?foreach($units as $i => $unit):?>
	<a href="?page=<?=$i?>"><?=$unit['title']?></a>
<?endforeach?>
<br />
<div style="margin:10px;"><?=$textStr?></div>
<img src="<?=$imageData?>" />
</div>