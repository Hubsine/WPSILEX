<?php

namespace DMarketPlace\Framework\Controller;

use DMarketPlace\DependencyInjection\Container;

/**
 * Description of BaseController
 *
 * @author nsi
 */
class BaseController {
    
    
    public $container;
    public $validator;


    //$this->forward('app.hello_controller:indexAction', array('name' => $name));
    
//    $response = $this->forward('AppBundle:Something:fancy', array(
//        'name'  => $name,
//        'color' => 'green',
//    ));

    public function __construct(Container $container) {
        
        $this->container = $container;
        //AnnotationRegistry::registerAutoloadNamespace("Symfony\Component\Validator\Constraints", DM_VENDOR_DIR.'/symfony/validaor');
//        $this->twig = $twig;
//        $this->formFactory = $formFactory;
        //var_dump($this->formFactory);
        
    }

    public function get($serviceId){
        return $this->container->get($serviceId);
    }

    public function createForm($type, $data, $options){
        
    }
    
    public function createBuilderForm($type = 'Symfony\Component\Form\Extension\Core\Type\FormType', $data = null, array $options = array()){
        return $this->get('form.factory')->createBuilder($type, $data, $options);
    }

    public function renderView($name, $parameters = array()){
        return $this->get('twig')->render($name, $parameters);
    }
    
    public function validate($entityObject){
       
        return $this->get('validator')->validate($entityObject);      
    }
    
    public function newMessage($subject = null, $body = null, $contentType = null, $charset = null){
        return $this->get('swift.message')->newMessage($subject, $body, $contentType, $charset);
    }
}
