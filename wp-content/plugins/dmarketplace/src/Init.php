<?php

namespace DMarketPlace;

use DMarketPlace\Shortcode\SellerShortcode;
//use Symfony\Component\DependencyInjection\ContainerBuilder;
use DMarketPlace\DependencyInjection\Container;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Form\Forms;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Storage\PhpBridgeSessionStorage;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\Yaml\Yaml;
use DMarketPlace\Framework\Controller\BaseController;
use DMarketPlace\Framework\Mapping\MappingAnnotationManager;

/**
 * Description of InitFramework
 *
 * @author nsi
 */
class Init {
    
    public $container;
    public $session;
    public static $request;


    public function __construct() {
        
        add_action('init', array($this, 'dm_session_start'));
        add_action('init', array($this, 'disable_wp_emojicons') );
        add_action('wp_enqueue_scripts', array($this, 'load_wp_resources'));
        
        $localeToLoad = $this->getLocaleFromWp();
        $localeToLoad = apply_filters('set_locale_translation', $localeToLoad);
        
        
        self::$request = Request::createFromGlobals();
        self::$request->setSession(new Session());
        self::$request->setLocale($localeToLoad);
        //self::$request = self::$request->create('*', 'GET', array('_controller' => 'DMarketPlace\Framework\Controller\SellerController::createAction'));
        
        
      
        
        $this->container = new Container();
        $this->container->set('container', $this->container);
       
        $this->load(); 
        $this->loadActions();
        new MappingAnnotationManager();
        
        #$this->container->get('repository.manager');
        $this->loadShortcode(); #Si on appel pas immédiatement les shortcodes, ces derniers ne sont pas initialisés
        //$baseController = new BaseController($this->container);

        //$baseController = $this->container->get('base.controller');
        
        //$this->container->get('controller.resolver');
        
        //var_dump(self::$request->attributes);
        //self::$request->attributes->add(array('_controller' => 'DMarketPlace\Framework\Controller\SellerController::createAction'));
        //$controllerResolver = new ControllerResolver();      
        //$c = $controllerResolver->getController(self::$request);
        //$c[0]->$c[1]();
        //var_dump($c);
        
    }
    
    public function dm_session_start(){
        if(!session_id()){
            session_start();
        }
    }

    protected function load(){
        
        $fileLocator = new FileLocator(DM_CONFIG_DIR); 
        $loader     = new YamlFileLoader($this->container, $fileLocator);
        
        $loader->load('parameters.yml');
        $loader->load('services.yml');
        
        
        
    }
    
    public function loadActions(){
        
        $actions = Yaml::parse(file_get_contents(DM_CONFIG_DIR.'/actions.yml'));
       
        //var_dump($actions);
        
        foreach ($actions as $key => $action) {
            self::$request->attributes->add($actions);
            self::$request->attributes->add($action['default']);
            //var_dump($action);
        }
        //$this->container->compile();
        //Register service in container
        //$formFactoryService = Forms::createFormFactoryBuilder();
        //$this->container->set('form.factory', $formFactoryService);
    }

    public function loadShortcode(){ 
        $this->container->get('shortcode.seller');
    }

    public function load_wp_resources(){
        
        wp_enqueue_style(
                'fortawesome', 
                plugins_url('dmarketplace/vendor/fortawesome/font-awesome/css/font-awesome.min.css'), 
                array(), 
                '4.6.3', 
                false);
        
        wp_enqueue_style(
                'bootstrap', 
                plugins_url('dmarketplace/vendor/twbs/bootstrap/dist/css/bootstrap.min.css'), 
                array(), 
                '3.3.7', 
                false);
        
    }

    public function disable_wp_emojicons() {
      // all actions related to emojis
      remove_action( 'admin_print_styles', 'print_emoji_styles' );
      remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
      remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
      remove_action( 'wp_print_styles', 'print_emoji_styles' );
      remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
      remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
      remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

      // filter to remove TinyMCE emojis
      //add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
    }

    public function getLocaleFromWp(){
        return explode('_', get_locale())[0];
    }
}
