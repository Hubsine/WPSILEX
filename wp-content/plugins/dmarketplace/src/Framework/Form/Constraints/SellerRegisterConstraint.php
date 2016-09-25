<?php

namespace DMarketPlace\Framework\Form\Constraints;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Email;

/**
 * Description of SellerRegisterConstraint
 *
 * @author Hubsine
 */
class SellerRegisterConstraint {
    
    public $username;
    public $firstName;
    public $lastName;
    public $email;


    public function __construct() {
        
        $this->username[] =
        $this->firstName[] = 
        $this->lastName[] =
        $this->email[] = new NotBlank();
        
        
        $options = array('min' => 2); 
        $this->username[] =
        $this->firstName[] = 
        $this->lastName[] = new Length($options);
        
        ###
        # Email
        ###
        $emailOptions = array('checkHost' => true);
        $this->email[] = new Email($emailOptions);
        
    }
    
}
