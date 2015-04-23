<?php
function p($x="..."){
    print "<div>$x</div>\n";
}

function pa($x){
    print "<div>". implode(', ', $x) ."</div>\n" ;
}


print '| <a href="pages.php?page=1">Page 1</a> |';
print '| <a href="pages.php?page=2">Page 2</a> |';
print '| <a href="pages.php?page=3">Page 3</a> |';

//print_r($_GET);

$page = (isset($_GET['page'])) ? $_GET['page'] : 1;

//$a = ['aa', 'bb', 'cc', 'dd'];
//if(in_array('bb', $a))
//    p('YEs!');

$contents = [
    'page1' => "I'm hurting, baby, I'm broken down
I need your loving, loving
I need it now
When I'm without you
I'm something weak
You got me begging, begging
I'm on my knees"
  ,
    'page2' => "I don't wanna be needing your love
I just wanna be deep in your love
And it's killing me when you're away
Ooh, baby, 'cause I really don't care where you are
I just wanna be there where you are
And I gotta get one little taste",
    'page3' => "Sugar
Yes, please
Won't you come and put it down on me
I'm right here, 'cause I need
Little love and little sympathy
Yeah you show me good loving
Make it alright
Need a little sweetness in my life
Sugar
Yes, please
Won't you come and put it down on me"
];

$title = "Page " . $page;

$content = $contents['page' . $page];

// ***************************************************

$content = str_replace("\n", " <br> ", $content);
$words = explode(" ", $content);
foreach($words as $key => $word){
	if(strpos($word, "<br>") !== FALSE){
		continue;
	}
	$words[$key] = "<span class=\"word\">$word</span>";
}
//print_r($words);
$content = implode(' ', $words);
//exit;
?>
<html>
	<head>
	    <title></title>
		<style>
			div.content{
				border: 1px solid #888888;
				background-color: #d8c6a6;
				text-align: justify;
				font-family: Arial;
				padding: 10px;
			}
			span.word{
				border-radius: 5px;
				border: 1px solid #884444;
				background-color: #5eb4f3;
				margin: 2px;
			}
		</style>
			
	
	</head>
<body>
	<h3><?php print $title; ?></h3>
	<div class="content"><?=$content?></div>
</body>
</html>
