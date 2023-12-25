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

$containerBuilder = new DI\ContainerBuilder();
$containerBuilder->useAttributes(true);
$containerBuilder->addDefinitions(ARKHIV_PLUGIN_DIR . 'config.php');
$container = $containerBuilder->build();

$frontend = $container->get(Frontend::class);
$frontend->register();


