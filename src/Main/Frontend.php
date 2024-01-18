<?php 

namespace Yugntruf\ZhurnalArkhiv\Main;

use Yugntruf\ZhurnalArkhiv\Admin\AdminPage;
use DI\Attribute\Inject;

class Frontend {
	
	function __construct(
		private Content $content,
		private Title $title,
		#[Inject('shortcode_text')] private string $shortcode
	) {}
	
	public function register(): void
    {
        
		$self = new self($this->content, $this->title, $this->shortcode);

		add_action('wp_print_scripts', [$self, 'enqueueScripts']);
		add_action('wp_print_styles', [$self, 'enqueueStyles']);
		add_shortcode($this->shortcode, [$this->content, 'output']);
		add_filter('pre_get_document_title', [$this->title, 'filter_title']);
		//Note: the following is a hook in the OceanWP theme
		//If the plugin is used with another theme this should be changed
		add_filter('ocean_title', [$this->title, 'filter_title']);
    }
	
	public function enqueueScripts(){
		if ( ! is_admin() ) {
			wp_enqueue_script('zhurnal-popup',
				ARKHIV_PLUGIN_URL . 'js/zhurnalpopup.js',
				array( 'jquery'), '1.0');
		}
	}
	
	public function enqueueStyles() {
		if ( ! is_admin() ) {
			wp_enqueue_style('zhurnal-style', 
			ARKHIV_PLUGIN_URL . 'css/zhurnal-style.css');
		}
	}
}