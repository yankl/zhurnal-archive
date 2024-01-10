<?php 

namespace Yugntruf\ZhurnalArkhiv\Main;

use DI\Attribute\Inject;

class Content {
	
	public function __construct(
	#[Inject('xmlpath')] private string $zhurnal_xml_path, 
	#[Inject('view_xsl')] private string $xslpath, 
	#[Inject('search_term')] private string $search_term, 
	#[Inject('mekhaber_nomen')] private string $mekhaber_nomen, 
	#[Inject('mekhaber_familye')] private string $mekhaber_familye, 
	#[Inject('numer_requested')] private string $numer_requested, 
	private Menu $menu,
	private Reader $reader,
	private Images $images,
	#[Inject('requested_view')] private string $page = 'main'
	) {}
	
	public function output($atts) {

		ob_start();
		include ARKHIV_PLUGIN_DIR . '/templates/zhurnal.php';
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}

	private function xml_with_xsl()
	{
		if ( !$this->xslpath )
			return '';
		
		$xml = simplexml_load_file($this->zhurnal_xml_path);

		$xsl = new \DOMDocument();
		$xsl->load($this->xslpath);

		$proc = new \XSLTProcessor();
		$proc->importStyleSheet($xsl);

		if ( $this->search_term )
			$proc->setParameter('', 'search_term', $this->search_term);
		$proc->setParameter('', 'familye', $this->mekhaber_familye);
		$proc->setParameter('', 'rest', $this->mekhaber_nomen);

		return $proc->transformToXML($xml);
	}
	
	private function reader_html() {
		if (!$this->numer_requested) return '';
		if (!$this->images->does_numer_exist($this->numer_requested)) return '';
		return $this->reader->html($this->numer_requested);
	}
}