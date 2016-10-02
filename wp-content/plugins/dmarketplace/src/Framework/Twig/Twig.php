<?php

namespace DMarketPlace\Framework\Twig;

use Symfony\Component\Form\Forms;
use Symfony\Bridge\Twig\Extension\FormExtension;
use Symfony\Bridge\Twig\Form\TwigRenderer;
use Symfony\Bridge\Twig\Form\TwigRendererEngine;
use Symfony\Component\Security\Csrf\CsrfTokenManager;
use Symfony\Bridge\Twig\TwigEngine;
use Symfony\Component\Templating\TemplateNameParser;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Translation\Loader\YamlFileLoader;
use Symfony\Component\Translation\Loader\XliffFileLoader;
use Symfony\Bridge\Twig\Extension\TranslationExtension;
use DMarketPlace\Init;

/**
 * Description of Twig
 *
 * @author nsi
 */
class Twig {
    
    public $defaultFormTheme;
    private $twigEngine;
    public $translator;


    public function __construct(Translator $translator, $defaultFormTheme) {
        
        $this->translator = $translator;
        $this->defaultFormTheme = apply_filters('default_form_theme', $defaultFormTheme);
        
        $this->load();
        // the path to TwigBridge library so Twig can locate the
        // form_div_layout.html.twig file
        

    }
    
    public function load(){
        
        $twig = new \Twig_Environment(null, array('debug' => true));
        
        $this->loadTemplating($twig);
        #$this->loadTranslation($twig);
        $this->addTranslationExtension($twig);
        
        $this->twigEngine = new TwigEngine($twig, new TemplateNameParser());
    }
    
    public function addTranslationExtension(\Twig_Environment $twig){
        
        $twig->addExtension(new TranslationExtension($this->translator));
        
        return $twig;
    }

    /**
     * @deprecated Deplacer dans Translator => A supprimer
     * @param \Twig_Environment $twig
     * @return \Twig_Environment
     */
    public function loadTranslation(\Twig_Environment $twig){
        
        $localeToLoad = Init::$request->getLocale();
        //$translator = new Translator($localeToLoad);
        $this->translator->addLoader('yaml', new YamlFileLoader());
        $this->translator->addLoader('xlf', new XliffFileLoader());
        
        foreach ($this->localesTransFolder as $key => $domainFolderName) {
                
            $currentFolder = DM_LOCALES_TRANS_DIR.'/'.$domainFolderName;

            if($currentResourceFolder = opendir($currentFolder)){
                while (false !== ($transFile = readdir($currentResourceFolder))) {
                    if(pathinfo($transFile, PATHINFO_EXTENSION) === 'yml'){
                        $ymlTransFile = $currentFolder.'/'.$transFile;
                        $locale = explode('.',pathinfo($ymlTransFile, PATHINFO_FILENAME));

                        if(isset($locale[1])){
                            $this->translator->addResource(
                                    'yaml', 
                                    $ymlTransFile, 
                                    $locale[1], 
                                    strtolower($domainFolderName)
                                    );
                        }
                    }
                    //$translator->addResource('yaml', $translationFile, basename($translationFile));
                }
                closedir($currentResourceFolder);
            }

        }
        
        //Load Symfony Validator Translation       
        $this->translator->addResource(
            'xlf',
            DM_VENDOR_FORM_DIR.'/Resources/translations/validators.'.$localeToLoad.'.xlf',
            $localeToLoad,
            'validators'
        );
        $this->translator->addResource(
            'xlf',
            DM_VENDOR_VALIDATOR_DIR.'/Resources/translations/validators.'.$localeToLoad.'.xlf',
            $localeToLoad,
            'validators'
        );

        // add the TranslationExtension (gives us trans and transChoice filters)
        #$this->translator = $translator;
        $twig->addExtension(new TranslationExtension($this->translator));
        
        return $twig;
        
    }

    protected function loadTemplating(\Twig_Environment $twig){
        
        $appVariableReflection = new \ReflectionClass('\Symfony\Bridge\Twig\AppVariable');
        $vendorTwigBridgeDir = dirname($appVariableReflection->getFileName());
        // the path to your other templates
        
        //Resources views
        $loader = new \Twig_Loader_Filesystem(array(
//            DM_VIEWS_DIR,
//            DM_VIEWS_FORMS_DIR,
//            DM_VIEWS_FORMS_DIR.'/extends',
            $vendorTwigBridgeDir.'/Resources/views/Form',
        ));
        
        $loader->addPath(DM_VIEWS_DIR, 'DMarketPlace');
        $loader->addPath(DM_VIEWS_FORMS_DIR, 'DMarketPlace:Forms');
        $loader->addPath(DM_VIEWS_FORMS_DIR.'/extends', 'DMarketPlace:Forms:Extends');
        $loader->addPath(DM_VIEWS_DIR.'/mails', 'DMarketPlace:Mails');
        
                
        $twig->setLoader($loader);
        //$twig = new \Twig_Environment($loader);
        $formEngine = new TwigRendererEngine(array($this->defaultFormTheme));
        $formEngine->setEnvironment($twig);
        
        $twig->addExtension(
            new FormExtension(new TwigRenderer($formEngine))
        );
        $twig->addExtension(new \Twig_Extension_Debug());
        
        return $twig;
    }


    public function render($name, array $parameters = array()){
        return $this->twigEngine->render($name, $parameters);
    }
}
