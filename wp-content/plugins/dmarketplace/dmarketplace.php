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



require_once __DIR__.'/functions.php';
require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/src/defines.php';
require_once __DIR__.'/src/Init.php';
include_once get_stylesheet_directory().'/dmarketplace-functions.php';

use Composer\Autoload\ClassLoader;
use DMarketPlace\Defines;
use DMarketPlace\Init;
use Doctrine\Common\Annotations\AnnotationRegistry;
#use DMarketPlace\DependencyInjection\Container;

$classMap = array(
    'DmErrors'  => DM_FRAMEWORK_DIR . '/Debug/DmErrors.php',
    'DmMessages' => DM_FRAMEWORK_DIR . '/Debug/DmMessages.php',
    'DmFormError' => DM_FRAMEWORK_DIR . '/Debug/DmFormError.php',
    'Util'    => DM_FRAMEWORK_DIR . '/Utils/Util.php',
    'SellerUtil'    => DM_FRAMEWORK_DIR . '/Utils/SellerUtil.php'
);

$loader = new ClassLoader();

$loader->addClassMap($classMap);
$loader->addPsr4('DMarketPlace\\', __DIR__.'/src');
#$loader->addPsr4('Framework\\', __DIR__.'/src/Framework');
$loader->register();

AnnotationRegistry::registerLoader(array($loader, 'loadClass'));



//add_action('after_setup_theme', 'launchInit', 1); 
//function launchInit(){
new Init();
//}


require_once DM_LIB_DIR.'/redux/admin/admin-init.php';

#global $container; 

//$container->get('translator');
//$container->get('wp.roles_caps');


#Redux::init('redux_builder_hubsine');

#$container->get('shortcode.seller');

#var_dump(Redux::getOption('redux_builder_hubsine', 'forms-seller-register'));