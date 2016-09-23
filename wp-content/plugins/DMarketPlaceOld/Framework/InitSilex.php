<?php

namespace DMarketPlace\Framework;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Translation\Loader\YamlFileLoader;
use Silex\Provider\ValidatorServiceProvider;
use Silex\Provider\FormServiceProvider;
use Silex\Provider\CsrfServiceProvider;
use Silex\Provider\TranslationServiceProvider;
use Silex\Provider\LocaleServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;

/**
 * Description of AbstractDefault
 *
 * @author nsi
 */
class InitSilex{
    
//    public $app; 
//    public $request;
//    public $appFormFactory;
//    public $appTwig;

    public $twigFormTemplates = array(
        );
    //public $twigTemplates = array('seller_registser_form.html.twig', '' );
    
    public function __construct() {
        
        global $app;
        global $silexRequest;
        
        $app = new Application();
        $app['debug'] = true;
        $silexRequest = Request::createFromGlobals();
        $app['request'] = $silexRequest;
        
        $app->register(new ValidatorServiceProvider());
        $app->register(new FormServiceProvider());
        $app->register(new CsrfServiceProvider());
        $app->register(new LocaleServiceProvider());
        $app->register(new TranslationServiceProvider());
        $app->register(new ServiceControllerServiceProvider());
        $app->register(new TwigServiceProvider(
                array(
                    'twig.options'  => array(
                        'debug' => true,
                        'cache' => true,
                        'auto_reload' => true,
                        'strict_variables' => true,
                        'autoescape' => true
                    ),
                    'twig.form.templates'   => $this->twigFormTemplates
                )));
        
        $app['twig.loader.filesystem']->addPath(VIEWS_DIR, 'DMarketPlaceViews');
        $app['twig.loader.filesystem']->addPath(VIEWS_FORMS_DIR, 'DMarketPlaceViewsForms');

       
        $this->loadTranslations();
        $app['translator']->setLocale(get_locale()); // A supprimer après

    }
    
    public function loadTranslations(){
        
        global $app;
       
        
        // Translator 
        $app->extend('translator', function($translator, $app) {
            
            global $localesTransFolder;
            $translator->addLoader('yaml', new YamlFileLoader());
            
            
            foreach ($localesTransFolder as $key => $domainFolderName) {
                
                $currentFolder = LOCALES_TRANS_DIR.'/'.$domainFolderName;
                
                if($currentResourceFolder = opendir($currentFolder)){
                    while (false !== ($transFile = readdir($currentResourceFolder))) {
                        if(pathinfo($transFile, PATHINFO_EXTENSION) === 'yml'){
                            $ymlTransFile = $currentFolder.'/'.$transFile;
                            $locale = explode('.',pathinfo($ymlTransFile, PATHINFO_FILENAME));
                         
                            if(isset($locale[1])){
                                $translator->addResource('yaml', $ymlTransFile, $locale[1], strtolower($domainFolderName));
                            }
                        }
                        //$translator->addResource('yaml', $translationFile, basename($translationFile));
                    }
                    closedir($currentResourceFolder);
                }
                
            }
            
            //$translator->addResource('yaml', __DIR__.'/locales/fr.yml', 'fr');

            return $translator;
        });
        
        //echo $app['translator']->trans('seller_registser.username', array(), 'form', get_locale());
    }
}
