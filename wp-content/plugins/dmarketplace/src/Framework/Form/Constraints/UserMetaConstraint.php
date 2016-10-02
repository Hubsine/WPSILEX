<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DMarketPlace\Framework\Form\Constraints;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Constraints\Choice;

/**
 * Description of UserMetaConstraint
 *
 * @author Hubsine
 */
class UserMetaConstraint {
    
    public $user_id;
    public $meta_key;
    public $meta_value;

    public function __construct() {
        
        $this->user_id[]    =
        $this->meta_key[]   =
        $this->meta_value[] = new NotBlank();
        
        $this->user_id[]    = new Type(array('type' => 'integer'));
        
        $this->meta_key[]   = new Choice(
                array(
                    'choices' => array('seller_status', 'seller_email_activation_status'), 
                    'multiple' => false,
                    'strict' => true
                )
            );
    }
}
