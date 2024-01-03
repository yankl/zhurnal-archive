<?php

namespace Yugntruf\ZhurnalArkhiv\Main;

use DI\Attribute\Inject;

class Reader {

	public function __construct( private Images $images ) {}

	/**
	* Outputs html for bookreader for given issue.
	*
	* @param string $numer
	*
	* @return string
	*/
	public function html($numer): string {
		$title = "יוגנטרוף נ׳ $numer";
		$data = $this->data_json($numer);

		ob_start();
		include ARKHIV_PLUGIN_DIR . '/templates/zhurnal-reader.php';
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}

	private function data_json($numer): string {
		$num_pages = $this->images->numer2pages($numer);

		$data_array = array();
		$spread = array();

		for ($page = 1; $page <= $this->images->numer2pages($numer); $page++) {
			$page_object = new \stdClass();
			$page_object->uri = $this->images->img_uri($numer, $page);
			$page_object->width = 1000; $page_object->height=1468;
			$spread[] = $page_object;

			if ( 1 == $page % 2 ) {
				$data_array[] = $spread;
				$spread = [];
			}
		}

		if ( $spread )
			$data_array[] = $spread;

		return json_encode($data_array, JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);
	}
}