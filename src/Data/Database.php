<?php 

namespace Yugntruf\ZhurnalArkhiv\Data;

use DI\Attribute\Inject;
use \Google\Client;

class Database {
	
	public function __construct(
		#[Inject('google_credentials')] private string $creds,
		#[Inject('zhurnal_db_spreadsheet_id')] private string $sheet_id,
		#[Inject('zhurnal_db_range_name')] private string $range,
		private array $dataColumns = 
			['titl' => 1,
			 'mekhaber' => 2,
			 'numer' => 3,
			 'zaytl' => 4,
			 'kategorye' => 5, 
			 'rubrik' => 6,
			]
	) {}
	
	public function spreadsheetAsJSON() {		
		$named_values = array_map([$this, 'nameRowDatapoints'], $this->spreadsheetValues());
		
		return json_encode($named_values);
	}
	
	private function spreadsheetValues() {
		$client = new Client();
		$client->setApplicationName("Zhurnal Arkhiv");
		$client->setScopes([\Google_Service_Sheets::SPREADSHEETS_READONLY]);
		$client->setAuthConfig($this->creds);
		$client->setAccessType('offline');
		$client->setPrompt('select_account consent');
		
		// configure the Sheets Service
		$service = new \Google_Service_Sheets($client);
		
		$response = $service->spreadsheets_values->get($this->sheet_id, $this->range);
		
		return $response->getValues();
	}
	
	private function nameRowDatapoints($row) {
		$namedRow = array();
		
		foreach ($this->dataColumns as $datum => $column) {
			$value = $row[$column - 1] ?? '';
			if ($value) $namedRow[$datum] = $value;
		}
		
		return $namedRow;		
	}
}