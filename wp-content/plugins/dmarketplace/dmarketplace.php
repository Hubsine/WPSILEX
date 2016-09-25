<?php
/* 
 * Plugin Name: D Market Place
 * Plugin URI: http://dmarketplace.com
 * Description: Plugin de market place pour woocommerce
 * Version: 0.1
 * Author: Hubsine
 * Author URI: https://hubsine.com   
 * Licence: GPL2
 */

//add_action('init', 'dm_session_start', 1);
//function dm_session_start(){
//    if(!session_id()){
//        session_start();
//    }
//}


require __DIR__.'/functions.php';
require __DIR__.'/vendor/autoload.php';
require __DIR__.'/src/defines.php';
require __DIR__.'/src/Init.php';
include_once get_stylesheet_directory().'/dmarketplace-functions.php';

use Composer\Autoload\ClassLoader;
use DMarketPlace\Defines;
use DMarketPlace\Init;
use Doctrine\Common\Annotations\AnnotationRegistry;

$loader = new ClassLoader();
$loader->addPsr4('DMarketPlace\\', __DIR__.'/src');
$loader->addPsr4('Framework\\', __DIR__.'/src/Framework');
$loader->register();

AnnotationRegistry::registerLoader(array($loader, 'loadClass'));

new Defines();

//add_action('after_setup_theme', 'launchInit', 1); 
//function launchInit(){
new Init();
//}

