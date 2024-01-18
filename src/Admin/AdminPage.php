<?php 

namespace Yugntruf\ZhurnalArkhiv\Admin;

use DI\Attribute\Inject;
use Yugntruf\ZhurnalArkhiv\Data\{LocalDatabase, RemoteDatabase};

class AdminPage {
	
	public function __construct(
		private LocalDatabase $localDb,
		private RemoteDatabase $remoteDb,
		#[Inject('zhurnal_db_spreadsheet_id')] private string $spreadsheetID,
	) {}
	
	public function register(): void {
		$self = new self($this->localDb, $this->remoteDb, $this->spreadsheetID);
		
		add_action('admin_menu', [$this, 'add_page']);
		add_action('wp_ajax_sync_zhurnal_db', [$this, 'syncDB']);
	}
	
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
	
	public function syncDB() {
		$json = $this->remoteDb->spreadsheetAsJSON();
		echo $this->localDb->storeDb($json);
		wp_die();
	}
}
