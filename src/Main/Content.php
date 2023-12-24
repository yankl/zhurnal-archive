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
		$this->zhurnal_xml_path = plugins_url('zhurnaln.xml', __FILE__);
		$output = $this->zhurnal_menu($menu_style, $active_flag);
		$output .= $this->search_form();
		if (isset($xslpath)) {
			if ( file_exists ($this->zhurnal_xml_path) )
				$output .= $this->xml_with_xsl($this->zhurnal_xml_path, plugins_url('xsl/' . $xslpath, __FILE__), $search_term);
			else
				$output .= "Couldn't load " . $this->zhurnal_xml_path;
		}
		return $output;
	}
	
	private function zhurnal_menu($menu_style, $active_flag) { 
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

	private function search_form() { 
		$search_html = <<<HTML
	<form id="zukh" action="/arkhiv/zukh/" method="get">
		<input type="text" class="yidbox" name="q" />
		<input type="submit" value="זוך!" />
	</form>
	HTML;
		return $search_html;
	}

	private function xml_with_xsl($xmlpath, $xslpath, $search_term = NULL)
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
	
}