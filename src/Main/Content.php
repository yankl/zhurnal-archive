<?php 

namespace Yugntruf\ZhurnalArkhiv\Main;

class Content {
	
	public function __construct(private string $zhurnal_xml_path, private string $page = 'main') {}
	
	public function output($atts) {
		
		$active_flag = array(
			'index' => '',
			'authors' => '',
			'tags' => '',
			'categories' => '',
		);
		
		$search_term = NULL;
		
		switch($this->page) {
			case 'main':
				$menu_style = 'main';
				break;
			case 'ale-numern':
				$menu_style = 'horizontal';
				$xslpath = 'zhurnalindex.xsl';
				$active_flag['index'] = 'active';
				break;
			case 'mekhabrim':
				$menu_style = 'horizontal';
				$xslpath = 'authors.xsl';
				$active_flag['authors'] = 'active';
				break;
			case 'zukhtsetl':
				$menu_style = 'horizontal';
				$xslpath = 'tags.xsl';
				$active_flag['tags'] = 'active';
				break;
			case 'kategoryes':
				$menu_style = 'horizontal';
				$xslpath = 'categories.xsl';
				$active_flag['categories'] = 'active';
				break;
			case 'zukh':
				$menu_style = 'horizontal';
				$xslpath = 'search.xsl';
				$search_term = $_GET['q'];
		}
		$this->zhurnal_xml_path = ARKHIV_PLUGIN_DIR . '/resources/zhurnaln.xml';
		$xsloutput = isset($xslpath)
			? $this->xml_with_xsl($this->zhurnal_xml_path, ARKHIV_PLUGIN_DIR .  '/xsl/' . $xslpath, $search_term)
			: $xsloutput = "Couldn't load " . $this->zhurnal_xml_path
			;
		ob_start();
		include ARKHIV_PLUGIN_DIR . '/templates/zhurnal.php';
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}

	private function xml_with_xsl($xmlpath, $xslpath, $search_term = NULL)
	{
		$xml = simplexml_load_file($xmlpath);

		$xsl = new \DOMDocument;
		$xsl->load($xslpath);

		$proc = new \XSLTProcessor;
		$proc->importStyleSheet($xsl);

		if ( ! is_null($search_term) )
			$proc->setParameter('', 'search_term', $search_term);

		return $proc->transformToXML($xml);
	}
	
}