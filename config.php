<?php 

$views = [
		'ale-numern' =>
			['text' => 'אַלע נומערן',
			'xsl' => 'zhurnalindex.xsl',
			'in-menu' => true],
		 'mekhabrim' =>
			['text' => 'מחברים',
			'xsl' => 'authors.xsl',
			'in-menu' => true],
		 'zukhtsetl' =>
			['text' => 'זוכצעטל',
			'xsl' => 'tags.xsl',
			'in-menu' => true],
		'kategoryes' =>
			['text' => 'קאַטעגאָריעס',
			'xsl' => 'categories.xsl',
			'in-menu' => true],
		'zukh' => 
			['text' => 'זוך',
			'xsl' => 'search.xsl',
			'in-menu' => false],
		];

$requested_view = $_GET['view'] ?? 'main';

$xsl_filename = $views[$requested_view]['xsl'] ?? '';

$xsl_path = $xsl_filename ? ARKHIV_PLUGIN_DIR . 'xsl/' . $xsl_filename : '';

return [
	'xmlpath' => ARKHIV_PLUGIN_DIR. 'resources/zhurnaln.xml',
	'images_folder' => 'assets/',
	'image_file_pattern' => 'YR.[numer].[zaytl].png',
	'requested_view' => $requested_view,
	'search_term' => $_GET['q'] ?? '',
	'views' => $views,
	'view_xsl' => $xsl_path
];