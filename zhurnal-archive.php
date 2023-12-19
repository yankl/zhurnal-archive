<?php
    /* 
    Plugin Name: Zhurnal Archive 
    Plugin URI:  http://yugntruf.org
    Description: Plugin for displaying data from the zhurnal archive 
    Author: Yankl-Perets Blum
    Version: 0.1 
    Author URI: 
    */  
	
use Yugntruf\ZhurnalArkhiv\Main\Frontend;

define('ARKHIV_PLUGIN_DIR', plugin_dir_path( __FILE__ ));

require __DIR__ . '/vendor/autoload.php';

Frontend::register();

$zhurnal_xml_path = plugins_url('zhurnaln.xml', __FILE__);

function zhurnal($atts) {
	extract(shortcode_atts(array(
		'page' => 'main',
	), $atts));
	
	$active_flag = array(
		'index' => '',
		'authors' => '',
		'tags' => '',
		'categories' => '',
	);
	
	$search_term = NULL;
	
	switch($page) {
		case 'main':
			$menu_style = 'main';
			break;
		case 'index':
			$menu_style = 'horizontal';
			$xslpath = 'zhurnalindex.xsl';
			$active_flag['index'] = 'active';
			break;
		case 'authors':
			$menu_style = 'horizontal';
			$xslpath = 'authors.xsl';
			$active_flag['authors'] = 'active';
			break;
		case 'tags':
			$menu_style = 'horizontal';
			$xslpath = 'tags.xsl';
			$active_flag['tags'] = 'active';
			break;
		case 'categories':
			$menu_style = 'horizontal';
			$xslpath = 'categories.xsl';
			$active_flag['categories'] = 'active';
			break;
		case 'search':
			$menu_style = 'horizontal';
			$xslpath = 'search.xsl';
			$search_term = $_GET['q'];
	}
	$zhurnal_xml_path = plugins_url('zhurnaln.xml', __FILE__);
	$output = zhurnal_menu($menu_style, $active_flag);
	$output .= search_form();
	if ($xslpath) {
		if ( file_exists ($zhurnal_xml_path) )
			$output .= xml_with_xsl($zhurnal_xml_path, plugins_url('xsl/' . $xslpath, __FILE__), $search_term);
		else
			$output .= "Couldn't load " . $zhurnal_xml_path;
	}
	return $output;
}



function zhurnal_menu($menu_style, $active_flag) { 
	$menu_html= <<<HTML
<h1 style="text-align:center">יוגנטרוף־אַרכיװ</h1>
<ul id="zhurnal-menu" class="$menu_style">
	<li><a class="{$active_flag['index']}" href="/arkhiv/ale-numern/">אַלע נומערן</a></li>
	<li><a class="{$active_flag['authors']}" href="/arkhiv/mekhabrim/">מחברים</a></li>
	<li><a class="{$active_flag['categories']}" href="/arkhiv/kategoryes/">קאַטעגאָריעס</a></li>
	<li><a class="{$active_flag['tags']}" href="/arkhiv/zukhtsetl/">זוכצעטל</a></li>
</ul>
HTML;

	return $menu_html;
}

function search_form() { 
	$search_html = <<<HTML
<form id="zukh" action="/arkhiv/zukh/" method="get">
	<input type="text" class="yidbox" name="q" />
	<input type="submit" value="זוך!" />
</form>
HTML;
	return $search_html;
}



function xml_with_xsl($xmlpath, $xslpath, $search_term = NULL)
{
	$xml = simplexml_load_file($xmlpath);

	$xsl = new DOMDocument;
	$xsl->load($xslpath);

	$proc = new XSLTProcessor;
	$proc->importStyleSheet($xsl);

	if ( ! is_null($search_term) )
		$proc->setParameter('', 'search_term', $search_term);

	return $proc->transformToXML($xml);
}