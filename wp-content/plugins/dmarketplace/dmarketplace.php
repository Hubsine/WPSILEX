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
require_once DM_LIB_DIR.'/redux/admin/admin-init.php';

use Composer\Autoload\ClassLoader;
use DMarketPlace\Defines;
use DMarketPlace\Init;
use Doctrine\Common\Annotations\AnnotationRegistry;

$loader = new ClassLoader();
$loader->addPsr4('DMarketPlace\\', __DIR__.'/src');
#$loader->addPsr4('Framework\\', __DIR__.'/src/Framework');
$loader->register();

AnnotationRegistry::registerLoader(array($loader, 'loadClass'));


//add_action('after_setup_theme', 'launchInit', 1); 
//function launchInit(){
new Init();
//}

#global $container; 

//$container->get('translator');
//$container->get('wp.roles_caps');


#Redux::init('redux_builder_hubsine');

#$container->get('shortcode.seller');

#var_dump(Redux::getOption('redux_builder_hubsine', 'forms-seller-register'));