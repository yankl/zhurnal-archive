<?php 

namespace Yugntruf\ZhurnalArkhiv\Main;

class Frontend {
	public static function register(): void
    {
        $self = new self();

		add_action('wp_print_scripts', [$self, 'enqueueScripts']);
		add_action('wp_print_styles', [$self, 'enqueueStyles']);
		add_shortcode('zhurnal', [$self, 'showContent']);
    }
	
	public function showContent($attrs) {
		return 'Test Content';
	}
	
	public function enqueueScripts(){
		if ( ! is_admin() ) {
			wp_enqueue_script('zhurnal-popup',
				ARKHIV_PLUGIN_DIR . 'js/zhurnalpopup.js',
				array( 'jquery'), '1.0');
		}
	}
	
	public function enqueueStyles() {
		if ( ! is_admin() ) {
			wp_enqueue_style('zhurnal-style', 
			ARKHIV_PLUGIN_DIR . 'css/zhurnal-style.css');
		}
	}
}