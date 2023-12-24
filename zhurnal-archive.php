<?php
    /* 
    Plugin Name: Zhurnal Archive 
    Plugin URI:  http://yugntruf.org
    Description: Plugin for displaying data from the zhurnal archive 
    Author: Yankl-Perets Blum
    Version: 0.1 
    Author URI: 
    */  
	
use Yugntruf\ZhurnalArkhiv\Main\Frontend;
use Yugntruf\ZhurnalArkhiv\Main\Content;

define('ARKHIV_PLUGIN_DIR', plugin_dir_path( __FILE__ ));

require __DIR__ . '/vendor/autoload.php';

$zhurnal_xml_path = plugins_url('zhurnaln.xml', __FILE__);

$frontend = new Frontend(new Content($zhurnal_xml_path));
$frontend->register();


