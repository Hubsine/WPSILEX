<?php

namespace DMarketPlace\Framework\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use DMarketPlace\Framework\Traits\DmActionEntity;
use Framework\Mapping\Annotations as WpMapping;

/**
 * Description of Seller
 *
 * WpMapping\WpUsers({WpUsers::TABLE_NAME})
 */
class Seller extends \WP_User{
    
    public function __construct(){
        parent::__construct();
    }

    /**
     *
     * @var integer
     */
    protected $id;
    
    /**
     *
     * @var trait DMarketPlace\Framework\Traits\DmActionEntity
     */
    use DmActionEntity;

    public function getId(){
        return $this->id;
    }

}
