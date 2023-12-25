<?php 

namespace Yugntruf\ZhurnalArkhiv\Main;

class Content {
	
	public function __construct(private string $zhurnal_xml_path, private string $page = 'main') {}
	
	public function output($atts) {
		
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
		
		$search_term = NULL;
		
		if ('zukh' == $this->page) {
			$search_term = $_GET['q'];
		}
		
		$xslpath = $views[$this->page]['xsl'];

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