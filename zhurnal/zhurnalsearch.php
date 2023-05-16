<?php
//$numer = $_GET["numer"];
header('Content-Type:text/html; charset=UTF-8');
$xml = simplexml_load_file('zhurnaln.xml');
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html>
	<head>
		<title>Zhurnal Search</title>
	</head>
	<body dir='rtl'>
<?php 
foreach ($xml->issue as $issue) {
	echo "<h1>Issue {$issue['num']}</h1>", PHP_EOL;
	foreach ($issue->article as $article) {
		echo "<a href='zhurnal.php?numer={$issue['num']}#page/{$article['page']}/mode/2up'>
$article->title</a>";
		if ($article->author) 
			echo " fun $article->author";
		echo "<br/>";
	}
}
 ?>
	</body>
</html>
