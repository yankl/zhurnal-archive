<?php 

namespace Yugntruf\ZhurnalArkhiv\Main;

use DI\Attribute\Inject;

class Images {
	
	public function __construct(
	#[Inject('images_folder')] private string $images_folder,
	#[Inject('image_file_pattern')] private string $images_file_pattern
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
	private function numer2pages_thehardway () {
		$file_pattern = str_replace( ['[numer]', '[zaytl]'], '*',
										$this->images_file_pattern );
		$search_pattern = $this->images_folder . '/' . $file_pattern;
		$num2pages = array();
		foreach (glob($search_pattern) as $filename) {
			//the pages are found between the second and third periods in the filename
			//This is not independent of the file pattern, but that would require 
			//more abstraction, regex which is not worth it since practically
			//speaking this will never change. 
			$pieces = explode('.', basename($filename));
			$numer = $pieces[1];
			$zaytl = $pieces[2];
			$num2pages[$numer][] = intval($zaytl);
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
}