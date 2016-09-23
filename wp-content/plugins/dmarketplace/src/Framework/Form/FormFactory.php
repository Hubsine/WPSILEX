<?php

namespace DMarketPlace\Framework\Form;

use Symfony\Component\Form\Forms;
use Symfony\Component\Form\Extension\Csrf\CsrfExtension;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\Extension\HttpFoundation\HttpFoundationExtension;
use Symfony\Component\Form\Extension\Core\CoreExtension;
use Symfony\Component\Security\Csrf\TokenStorage\NativeSessionTokenStorage;
use Symfony\Component\Security\Csrf\TokenGenerator\UriSafeTokenGenerator;
use Symfony\Component\Security\Csrf\CsrfTokenManager;
use DMarketPlace\Framework\Validator\Validator;

/**
 * Description of DmFormFactory
 *
 * @author nsi
 */
class FormFactory{
    
    private $factory;
    private $builder;
    private $extensions;
    private $validator;

    public function __construct(Validator $validator) {
        
        $this->builder = Forms::createFormFactoryBuilder();
        $this->factory = Forms::createFormFactory();
        $this->validator = $validator;
        
        $this->loadExtensions(); 
        
    }
    
    protected function loadExtensions(){

        // CSRF Extension
        $csrfGenerator = new UriSafeTokenGenerator();
        $csrfStorage = new NativeSessionTokenStorage();
        $csrfManager = new CsrfTokenManager($csrfGenerator, $csrfStorage);        
        $csrfExtension = new CsrfExtension($csrfManager);
        
        $this->extensions[] = $csrfExtension;
        
        
        // Validator Extension        
        $validator = $this->validator->getValidator(); 
        $validatorExtension = new  ValidatorExtension($validator);
        
        $this->extensions[] = $validatorExtension;  
        
        
        // HttpFoundation Extension
        $httpFoundation = new HttpFoundationExtension();
        $this->extensions[] = $httpFoundation;
        
        //Core
        $core = new CoreExtension();
        $this->extensions[] = $core;
        
    }
    
    public function createBuilder($type = 'Symfony\Component\Form\Extension\Core\Type\FormType', $data = null, array $options = array()){

        return $formFactory = Forms::createFormFactoryBuilder()
            ->addExtensions($this->extensions)
            ->getFormFactory()
            ->createBuilder($type, $data, $options)
        ;
    }
    
    
}
