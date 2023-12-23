<?php 

namespace Yugntruf\ZhurnalArkhiv\Main;

class Frontend {
	
	function __construct(private Content $content) {}
	
	public function register(): void
    {
        $self = new self($this->content);

		add_action('wp_print_scripts', [$self, 'enqueueScripts']);
		add_action('wp_print_styles', [$self, 'enqueueStyles']);
		add_shortcode('zhurnal', [$this->content, 'output']);
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