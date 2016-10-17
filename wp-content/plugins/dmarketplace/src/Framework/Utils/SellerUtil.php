<?php

namespace DMarketPlace\Framework\Utils;

use DMarketPlace\Framework\Utils\Util;
use DMarketPlace\Framework\Repository\SellerRepository;

/**
 * @deprecated non utiliser, à supprimer au mieux
 */
class SellerUtil extends Util{
    
    const ACTION_CREATE = 'SELLER_CREATE';
    const ACTION_READ   = 'SELLER_READ';
    const ACTION_UPDATE = 'SELLER_UPDATE';
    const ACTION_DELETE = 'SELLER_DELETE';
    
    const REPOSITORY_CLASS   = SellerRepository::class;
    const ROLENAME_SELLER              = 'seller_role';
    
    // Status 
//    static $sellerMetas   = array(
//        'seller_status' => array(
//            'pending_email_validation', 
//            'pending_admin_validation',
//            'validate'
//            ),
//        'seller_email_activation_status' => array()
//    );

    const META_KEY_SELLER_STATUS              = 'seller_status';
    const META_KEY_ACTIVATION_EMAIL           = 'seller_email_activation_status';
    const META_VALUE_PENDING_EMAIL_VALIDATION        = 'pending_email_validation';
    
    public static function getRegisterFormName(){
        
        $formName = parent::getReduxOption('dm-forms-seller-register');
        
        return ( empty( $formName ) || $formName === 'Default Text' ) ? 'seller_register_form.html.twig' : $formName  ;
    }
    
}

