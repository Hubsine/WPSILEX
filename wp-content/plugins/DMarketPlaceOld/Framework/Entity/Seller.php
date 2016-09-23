<?php

namespace DMarketPlace\Framework\Entity;

use Symfony\Component\Validator\Constraint as Assert;
use DMarketPlace\Framework\Traits\DmActionEntity;
use DMarketPlace\Framework\Model\SellerInterface;

/**
 * Description of Seller
 *
 * @author nsi
 */
class Seller implements SellerInterface {
    
    public function __construct(){
        
        
    }

        /**
     *
     * @var String
     * 
     * @Assert\NotBlank()
     * 
     */
    protected $username;
    
    /**
     *
     * @var String
     * 
     * @Assert\NotBlank()
     * 
     */
    protected $firstName;
    
    /**
     *
     * @var String
     * 
     * @Assert\NotBlank()
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
    
    public function getFirstName(){
        return $this->lastName;
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
