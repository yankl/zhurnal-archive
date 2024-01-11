<?php 

namespace Yugntruf\ZhurnalArkhiv\Main;

use DI\Attribute\Inject;

class Frontend {
	
	function __construct(
		private Content $content,
		#[Inject('shortcode_text')] private string $shortcode
	) {}
	
	public function register(): void
    {
        $self = new self($this->content, $this->shortcode);

		add_action('wp_print_scripts', [$self, 'enqueueScripts']);
		add_action('wp_print_styles', [$self, 'enqueueStyles']);
		add_shortcode($this->shortcode, [$this->content, 'output']);
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