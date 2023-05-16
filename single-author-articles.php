<?php
$zhurnal_xml_path = 'zhurnaln.xml';
$xslpath = 'xsl/single-author.xsl';

$xml = simplexml_load_file($zhurnal_xml_path);

$xsl = new DOMDocument;
$xsl->load($xslpath);

$proc = new XSLTProcessor;
$proc->importStyleSheet($xsl);
$proc->setParameter('','familye',$_GET['familye']);
$proc->setParameter('','rest',$_GET['rest']);

$output = $proc->transformToXML($xml);


$author = $_GET['familye'] . $_GET['rest'];

?>
<html dir='rtl' lang="yi">
	<head>
		<style type="text/css">
			body {font-family:sans-serif;
			background-color:#D6EBFF}
		</style>
		
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> 
		
	</head>
	<body>
		<h1 style='text-align:center'>אַלע אַרטיקלען פֿון <?php echo $_GET['rest'] . ' ' . $_GET['familye']; ?></h1>
		<?php
		echo $single_author_xsl; echo $output; ?>
	</body>
</html>