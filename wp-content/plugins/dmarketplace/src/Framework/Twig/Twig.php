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
    
    protected function load(){
        
        $twig = new \Twig_Environment(null, array('debug' => true));
        
        $this->loadTemplating($twig);
        $this->addTranslationExtension($twig);
        
        $this->twigEngine = new TwigEngine($twig, new TemplateNameParser());
    }
    
    protected function addTranslationExtension(\Twig_Environment $twig){
        
        $twig->addExtension(new TranslationExtension($this->translator));
        
        return $twig;
    }
    
    protected function loadTemplating(\Twig_Environment $twig){
        
        $appVariableReflection = new \ReflectionClass('\Symfony\Bridge\Twig\AppVariable');
        $vendorTwigBridgeDir = dirname($appVariableReflection->getFileName());
        
        //Resources views
        $loader = new \Twig_Loader_Filesystem(array(
//            DM_VIEWS_DIR,
//            DM_VIEWS_FORMS_DIR,
//            DM_VIEWS_FORMS_DIR.'/extends',
            $vendorTwigBridgeDir.'/Resources/views/Form',
        ));
        
#        $loader->addPath($vendorTwigBridgeDir.'/Resources/views/Form');
        $loader->addPath(DM_VIEWS_DIR, 'DMarketPlace');
        $loader->addPath(DM_VIEWS_FORMS_DIR, 'DMarketPlace:Forms');
        $loader->addPath(DM_VIEWS_FORMS_DIR.'/extends', 'DMarketPlace:Forms:Extends');
        $loader->addPath(DM_VIEWS_DIR.'/mails', 'DMarketPlace:Mails');
        
                
        $twig->setLoader($loader);
        //$twig = new \Twig_Environment($loader);
        $formEngine = new TwigRendererEngine(array($this->defaultFormTheme = 'form_div_layout.html.twig'));
        $formEngine->setEnvironment($twig);
        
        $twig->addExtension(
            new FormExtension(new TwigRenderer($formEngine))
        );
        $twig->addExtension(new \Twig_Extension_Debug());
        
        return $twig;
    }


    public function render($name, $parameters = array()){
        return $this->twigEngine->render($name, $parameters);
    }
}
