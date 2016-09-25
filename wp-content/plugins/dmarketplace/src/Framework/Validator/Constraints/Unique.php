<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DMarketPlace\Framework\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
/**
 * @Annotation
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
 *
 * @author Hubsine
 */
class Unique extends Constraint{
    
    public $message = "existing.unique";
    
    /**
     *
     * @var string
     * 
     * @Enum({"user_login", "user_pass", "user_nicename", "user_email", "user_status", "display_name"})
     */
    public $column;


    public function validatedBy(){
        return get_class($this).'Validator';
    }
}
