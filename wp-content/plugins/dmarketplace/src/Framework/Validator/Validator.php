<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DMarketPlace\Framework\Validator;

use Doctrine\Common\Annotations\AnnotationRegistry;
use Symfony\Component\Validator\Validation;

/**
 * Description of Validator
 *
 * @author nsi
 */
class Validator{
    
    public $validator; 
    
    public function __construct() {
        
        $this->loadConstraints();
        $this->enableAnnotationMapping();
        
    }
    
    private function loadConstraints(){
        
        if($currentConstraintFolder = opendir(DM_VENDOR_DIR."/symfony/validator/Constraints")){
            while (false !== ($constraintFile = readdir($currentConstraintFolder))) {
                //echo $transFile;
                if(pathinfo($constraintFile, PATHINFO_EXTENSION) === 'php'){ 
                    AnnotationRegistry::registerFile(DM_VENDOR_DIR."/symfony/validator/Constraints/".$constraintFile);
                }
            }
            closedir($currentConstraintFolder);
        }
    }
    
    private function enableAnnotationMapping(){
        
        $this->validator = Validation::createValidatorBuilder()
        #->enableAnnotationMapping()                
        ->getValidator();
    }

    public function validate($value, $constraints = null, $groups = null){
        
        return $this->validator->validate($value, $constraints, $groups);    
        
    }
    
    public function getValidator(){
        return $this->validator;
    }
}
