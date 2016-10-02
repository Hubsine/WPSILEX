<?php

namespace DMarketPlace\Framework\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use DMarketPlace\Framework\Traits\DmActionEntity;
use Framework\Mapping\Annotations as WpMapping;
use DMarketPlace\Framework\Utils\SellerUtil;

/**
 * Description of Seller
 *
 * @property string $nickname
 * @property string $description
 * @property string $user_description
 * @property string $first_name
 * @property string $user_firstname
 * @property string $last_name
 * @property string $user_lastname
 * @property string $user_login
 * @property string $user_pass
 * @property string $user_nicename
 * @property string $user_email
 * @property string $user_url
 * @property string $user_registered
 * @property string $user_activation_key
 * @property string $user_status
 * @property string $display_name
 * @property string $spam
 * @property string $deleted
 */
class Seller extends \WP_User{
    
    public function __construct(){
        
        parent::__construct();
        
        
    }
    
    /**
     *
     * @var array DMarketPlace\Framework\Entity\UserMeta
     */
    public $seller_meta;

    /**
     *
     * @var trait DMarketPlace\Framework\Traits\DmActionEntity
     */
    use DmActionEntity;

}
