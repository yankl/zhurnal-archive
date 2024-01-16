<?php 

namespace Yugntruf\ZhurnalArkhiv\Admin;

class AdminPage {
	
	function __construct() {}
	
	public function add_page() {
		add_menu_page(
			'Zhurnal Arkhiv',
			'Zhurnal Arkhiv',
			'manage_options',
			'zhurnal-arkhiv',
			array( $this, 'render' ),
			'dashicons-admin-page',
			null
		);
	}
	
	function render() {
		include ARKHIV_PLUGIN_DIR . '/templates/admin-page.php';
	}
}
