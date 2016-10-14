<?php


        define('DM_OPT_NAME', 'dmarketplace');

        define('DM_PLUGIN_DIR',            realpath(__DIR__.'/..')); 
        define('DM_SRC_DIR',               DM_PLUGIN_DIR.'/src');
        define('DM_LIB_DIR',               DM_PLUGIN_DIR.'/lib');
        
        define('DM_FRAMEWORK_DIR',         DM_SRC_DIR.'/Framework');
        define('DM_CONFIG_DIR',            DM_SRC_DIR.'/Config');
        define('DM_RESOURCES_DIR',         DM_SRC_DIR.'/resources');
        
        define('DM_VIEWS_DIR',             DM_RESOURCES_DIR.'/views');
        define('DM_VIEWS_FORMS_DIR',       DM_VIEWS_DIR.'/forms');
        define('DM_LOCALES_TRANS_DIR',     DM_RESOURCES_DIR.'/translations');

        // VENDOR
        define('DM_VENDOR_DIR', realpath(__DIR__.'/../vendor')); 
        define('DM_VENDOR_FORM_DIR', DM_VENDOR_DIR.'/symfony/form');
        define('DM_VENDOR_VALIDATOR_DIR', DM_VENDOR_DIR.'/symfony/validator');
        
        
        // URI
        define('DM_PLUGIN_URI', plugins_url('/dmarketplace'));
        define('DM_RESOURCES_URI', DM_PLUGIN_URI.'/src/resources');
        define('DM_VENDOR_URI', DM_PLUGIN_URI.'/vendor');
        
        define('DM_BOOTSTRAP_URI', DM_VENDOR_URI.'/twbs/bootstrap');
        define('DM_FORTAWESOME_URI', DM_VENDOR_URI.'/fortawesome/font-awesome');
        
        // DB
        define('USER_TABLE', 'wp_users');
        define('POST_TABLE', 'wp_posts');
        
        
        #define('ACTIONS_DIR',           DM_PLUGIN_DIR.'/Actions');

//        global $actions;
//        $actions = array(
//            'seller_login',
//            'seller_register'
//        );

//        global $classToAutoload;
//        $classToAutoload = array(
//            'Model'         => array('SellerInterface'),
//            'Traits'        => array('DmActionEntity'),
//            'Entity'        => array('Seller'),
//            'Form'          => array('SellerRegisterType'),
//            'Repository'    => array('SellerRepository'),
//            'Controller'    => array('SellerController'),
//            'Shortcode'     => array('SellerShortcode')
//        );

//        global $silexActions;
//        $silexActions = ['Seller'];
//
//        // no utilisé => à effacer
//        global $locales;
//        $locales = array('en', 'fr', 'es', 'de');
//
//        global $localesTransFolder;
//        $localesTransFolder = array('Form', 'Validator', 'Message');
    