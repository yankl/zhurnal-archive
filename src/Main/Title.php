<?php 

namespace Yugntruf\ZhurnalArkhiv\Main;

use DI\Attribute\Inject;

class Title {
	
	public function __construct(
	#[Inject('search_term')] private string $search_term, 
	#[Inject('mekhaber_nomen')] private string $mekhaber_nomen, 
	#[Inject('mekhaber_familye')] private string $mekhaber_familye, 
	#[Inject('numer_requested')] private string $numer_requested, 
	#[Inject('shortcode_text')] private string $shortcode,
	#[Inject('page')] private string $page = 'main',
	) {}
	
	public function filter_title($original_title): string {
		// don't change title on admin pages or when global $post is not loaded
		if (is_admin() || get_the_ID() === false) {
			return $original_title;
		}
		
		// don't change title if shortcode is not present in content
		if (!has_shortcode(get_the_content(), $this->shortcode)) {
			return $original_title;
		}
		
		$base_title = 'יוגנטרוף־אַרכיװ';
		$addendum = '';
		
		switch ($this->page) {
			case 'mekhaber':
				$addendum =  'אַלע אַרטיקלען פֿון ' 
				. $this->mekhaber_nomen 
				. ' ' . $this->mekhaber_familye;
			break;
			case 'zukh':
				$addendum = "רעזולטאַטן פֿאַר „{$this->search_term}“";
				break;
		}
		
		if ( !$addendum )
			return $base_title;
		
		return implode(': ', [$base_title, esc_html($addendum)]);
	}
}