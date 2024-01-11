<?php 

namespace Yugntruf\ZhurnalArkhiv\Main;

use DI\Attribute\Inject;

class Menu {
	public function __construct(
	#[Inject('views')] private array $views,
	#[Inject('page')] private string $current_page
	) {}
	
	public function html_output() {
		ob_start();
		include ARKHIV_PLUGIN_DIR . '/templates/menu-template.php';
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}

}