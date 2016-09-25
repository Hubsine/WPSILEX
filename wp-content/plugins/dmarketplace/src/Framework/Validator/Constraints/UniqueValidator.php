<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DMarketPlace\Framework\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Description of UniqueValidator
 *
 * @author Hubsine
 */
class UniqueValidator extends ConstraintValidator{
    
    public function validate($value, Constraint $constraint)
    {
        
        $column = $constraint->column;
        $message = $constraint->message;
        $existe = false;

        switch ($column){
            
            case 'user_login':
                $existe = (username_exists($value) !== false) ? true : false; 
                break;
            
            case 'user_email':
                $existe = (email_exists($value) !== false) ? true : false;  
                break;
        }
        
        
        if($existe){
            $this
                ->context
                ->buildViolation($constraint->message)
                ->addViolation();
        }
//        if (!preg_match('/^[a-zA-Z0-9]+$/', $value, $matches)) {
//            $this->context->buildViolation($constraint->message)
//                ->setParameter('%string%', $value)
//                ->addViolation();
//        }
    }
    
}
