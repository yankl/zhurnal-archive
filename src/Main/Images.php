<?php

namespace Yugntruf\ZhurnalArkhiv\Main;

use DI\Attribute\Inject;

class Images {

	public function __construct(
	#[Inject('images_folder')] private string $images_folder,
	#[Inject('image_file_pattern')] private string $images_file_pattern,
	private string $cache_filename = ARKHIV_PLUGIN_DIR . 'data/num2pages.txt',
	) {}

	/**
	*
	* Return the number of pages a give issue has
	* based on the number of images.
	*
	* @param string $numer
	*
	* @return array
	*/
	public function numer2pages($numer) {
		if (!$this->does_numer_exist($numer))
			throw new \ValueError("The issue {$numer} is not on file.", 1);
		return $this->get_num2pages_array()[$numer];
	}

	public function img_uri ($numer, $zaytl) {
		$filename = str_replace(
					['[numer]', '[zaytl]'],
					[$numer, $zaytl],
					$this->images_file_pattern
					);

		return ARKHIV_PLUGIN_URL . $this->images_folder . $filename;
	}

	public function does_numer_exist($numer) {
		return array_key_exists($numer, $this->get_num2pages_array());
	}

	private function get_num2pages_array() {
		$num2pages = $this->cached_num2pages();

		if (false == $num2pages)
			$num2pages = $this->cached_num2pages($this->numer2pages_thehardway());

		if (false === $num2pages)
			throw new \Exception("Error writing file {$this->cache_filename}.");

		return $num2pages;
	}

	/**
	*
	* Return the number of pages a give issue has
	* based on the number of images.
	*
	* @return array
	*/
	private function numer2pages_thehardway () {
		$file_pattern = str_replace( ['[numer]', '[zaytl]'], '*',
										$this->images_file_pattern );
		$search_pattern = ARKHIV_PLUGIN_DIR . $this->images_folder . $file_pattern;
		$num2pages = array();
		foreach (glob($search_pattern) as $filename) {
			//the pages are found between the second and third periods in the filename
			//This is not independent of the file pattern, but that would require
			//more abstraction, regex which is not worth it since practically
			//speaking this will never change.
			$pieces = explode('.', basename($filename));
			$numer = (string) $pieces[1];
			$zaytl = (int) $pieces[2];
			$num2pages[$numer][] = $zaytl;
		}

		// Make sure no pages are missing before the end
		// and that the number of pages are even
		foreach ($num2pages as $numer => $numarray) {
			if (max ($numarray) == count($numarray) and max($numarray) % 2 == 0 )
				continue ;

			throw new Exception("It seems there are pages missing in issue $numer.");
		}

		$num2count = array();
		foreach ($num2pages as $numer => $pages) $num2count[$numer] = count($pages);
		return $num2count;
	}

	private function cached_num2pages(array $num2pages = null) {
		if (is_null ( $num2pages ) ) {
			if (!file_exists($this->cache_filename))
				return false;
			$num2pages = unserialize(file_get_contents($this->cache_filename));
		} else {
			if (false === file_put_contents($this->cache_filename, serialize($num2pages)))
				return false;
		}

		return $num2pages;
	}
}