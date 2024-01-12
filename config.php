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

$requested_view = $_GET['view'] ?? '';

$page = in_array($requested_view, array_keys($views)) ? $requested_view : 'main';

$mekhaber_nomen =  $_GET['nomen'] ?? '';
$mekhaber_familye = $_GET['familye'] ?? '';
$numer_requested = $_GET['numer'] ??  '';
$search_term = $_GET['q'] ?? '';

$xsl_filename = $views[$requested_view]['xsl'] ?? '';

if ( $mekhaber_nomen | $mekhaber_familye ) {
	$xsl_filename = 'single-author.xsl';
	$page = 'mekhaber';
}

if ( $numer_requested ) $page = 'reader';

$xsl_path = $xsl_filename ? ARKHIV_PLUGIN_DIR . 'xsl/' . $xsl_filename : '';

return [
	'shortcode_text' => 'zhurnal',
	'xmlpath' => ARKHIV_PLUGIN_DIR. 'resources/zhurnaln.xml',
	'images_folder' => 'assets/',
	'image_file_pattern' => 'YR.[numer].[zaytl].png',
	'page' => $page,
	'search_term' => sanitize_text_field( $search_term ),
	'mekhaber_nomen' => sanitize_text_field( $mekhaber_nomen ),
	'mekhaber_familye' => sanitize_text_field( $mekhaber_familye ),
	'numer_requested' => sanitize_text_field( $numer_requested ),
	'views' => $views,
	'view_xsl' => $xsl_path
];