<?php include '../common.php';

// tmp file
$testData = 'test data ' . (string) microtime(1);
$tmpFile1001 = 'source/1001.txt';
file_put_contents($tmpFile1001, $testData); // tmp file
// files
$files = ['1.txt', '2.txt', '1001.txt'];


// Zip object
$zip = new ZipArchive;

$index = str_replace(' ', '_', (string) microtime(1));
p("tmp_$index.zip");

// open archive
if(! $zip->open("zipped/tmp_$index.zip", ZIPARCHIVE::CREATE)){
	die('zip file opening failed!');
}
// add files
foreach($files as $file){
	if(!$zip->addFile("source/$file", $file)){
		die("Unable to add file(1) $file !");
	}
}

// add new Dir
if(! $zip->addEmptyDir('sub_dir')){
	die('Unable add new dir!');
}

// add some file to sub dir
$subFile = 'sub-file-1.txt';
if(! $zip->addFile("source/$subFile", "sub_dir/$subFile")){
	die('Unable to add file(2)!');
}

// close Zip
$zip->close();

// delete tmp file
unlink($tmpFile1001);

