<?php

define('PLUGIN_DIR',            __DIR__);
define('FRAMEWORK_DIR',         PLUGIN_DIR.'/Framework');
define('RESOURCES_DIR',         PLUGIN_DIR.'/Resources');
define('VIEWS_DIR',             RESOURCES_DIR.'/views');
define('VIEWS_FORMS_DIR',       VIEWS_DIR.'/forms');
define('LOCALES_TRANS_DIR',     RESOURCES_DIR.'/Translations');
define('ACTIONS_DIR',           PLUGIN_DIR.'/Actions');

global $actions;
$actions = array(
    'seller_login',
    'seller_register'
);

global $classToAutoload;
$classToAutoload = array(
    'Model'         => array('SellerInterface'),
    'Traits'        => array('DmActionEntity'),
    'Entity'        => array('Seller'),
    'Form'          => array('SellerRegisterType'),
    'Repository'    => array('SellerRepository'),
    'Controller'    => array('SellerController'),
    'Shortcode'     => array('SellerShortcode')
);

global $silexActions;
$silexActions = ['Seller'];

// no utilisé => à effacer
global $locales;
$locales = array('en', 'fr', 'es', 'de');

global $localesTransFolder;
$localesTransFolder = array('Form', 'Validator', 'Message');