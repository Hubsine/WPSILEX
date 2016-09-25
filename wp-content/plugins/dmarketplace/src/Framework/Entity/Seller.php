<?php

namespace DMarketPlace\Framework\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use DMarketPlace\Framework\Traits\DmActionEntity;
use DMarketPlace\Framework\Model\SellerInterface;
use Framework\Mapping\Annotations as WpMapping;

/**
 * Description of Seller
 *
 * WpMapping\WpUsers({WpUsers::TABLE_NAME})
 */
class Seller implements SellerInterface {
    
    public function __construct(){
        
        
    }

    /**
     *
     * @var String
     * 
     * @WpMapping\WpUsers(column="user_login")
     * @Assert\NotBlank(groups={"SellerRegistration"})
     * 
     */
    protected $username;
    
    /**
     *
     * @var String
     * 
     * WpMapping\Email(column="user_email")
     * @Assert\NotBlank()
     */
    protected $email;
    
    /**
     *
     * @var String
     * 
     * @Assert\NotBlank(groups={"SellerRegistration"})
     * 
     */
    protected $firstName;
    
    /**
     *
     * @var String
     * 
     * @Assert\NotBlank(groups={"SellerRegistration"})
     * 
     */
    protected $lastName;
    
    /**
     *
     * @var String
     */
    use DmActionEntity;

    public function getUsername(){
        return $this->username;
    }
    
    public function setUsername($username){
        
        $this->username = $username;
        
        return $this;
    }
    
    public function getEmail(){
        return $this->email;
    }
    
    public function setEmail($email){
        
        $this->email = $email;
        
        return $this;
    }

    public function getFirstName(){
        return $this->firstName;
    }
    
    public function setFirstName($firstName){
        
        $this->firstName = $firstName;
        
        return $this;
    }
    
    public function getLastName(){
        return $this->lastName;
    }
    
    public function setLastName($lastName){
        
        $this->lastName = $lastName;
        
        return $this;
    }
    
}
