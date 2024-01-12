<?php 

namespace Yugntruf\ZhurnalArkhiv\Main;

use DI\Attribute\Inject;

class Menu {
	public function __construct(
	#[Inject('views')] private array $views,
	#[Inject('page')] private string $current_page
	) {}
	
	public function html_output() {
		if ( $this->current_page == 'reader' 
			or $this->current_page == 'mekhaber' )
			$template_path = 'back-button.php';
		else
			$template_path = 'menu-template.php';
			
		ob_start();
		include ARKHIV_PLUGIN_DIR . '/templates/' . $template_path;
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}

}