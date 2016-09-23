<?php

/* 
 * Plugin Name: DMarketPlaceOld
 * Plugin URI: http://dmarketplace.com
 * Description: Plugin de market place pour woocommerce
 * Version: 0.1
 * Author: Hubsine
 * Author URI: https://hubsine.com   
 * Licence: GPL2
 */

require_once __DIR__.'/defines.php';

require_once __DIR__.'/lib/silex/vendor/autoload.php';
require_once __DIR__.'/autoloadPluginClass.php';


require_once FRAMEWORK_DIR.'/InitSilex.php';
require_once __DIR__.'/init.php';

// Load actions files for silex
foreach ($silexActions as $key => $fileName) {
    require_once ACTIONS_DIR.'/'.$fileName.'.php';
}

global $app;
global $silexRequest;
