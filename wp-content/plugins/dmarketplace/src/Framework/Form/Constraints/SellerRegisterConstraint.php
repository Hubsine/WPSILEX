<?php

namespace DMarketPlace\Framework\Form\Constraints;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Type;
use DMarketPlace\Framework\Validator\Constraints\Unique;

/**
 * Description of SellerRegisterConstraint
 *
 * @author Hubsine
 */
class SellerRegisterConstraint {
    
    public $user_login;
    public $first_name;
    public $last_name;
    public $user_email;
    public $nickname;
    public $display_name;

    public function __construct() {
        
        $this->user_login[] =
        $this->first_name[] = 
        $this->last_name[] = 
        $this->nickname[] = 
        $this->display_name[] = new Type(array('type' => 'string'));

        $this->user_login[] =
        $this->first_name[] = 
        $this->last_name[] =
        $this->user_email[] =
        $this->nickname[] = 
        $this->display_name[] = new NotBlank();
        
        $options = array('min' => 2); 
        $this->first_name[] = 
        $this->last_name[] = 
        $this->nickname[] = 
        $this->display_name[] = new Length($options);
        
        ###
        # User Login
        ###
        $this->user_login[] = new Length(array('min' => 2, 'max' => 60));
        $this->user_login[] = new Unique(array('message' => 'existing.user_login', 'column' => 'user_login'));
        
        ###
        # Email
        ###
        $this->user_email[] = new Unique(array('message' => 'existing.user_email', 'column' => 'user_email'));
        $this->user_email[] = new Email(array('checkHost' => true));
        
    }
    
}
