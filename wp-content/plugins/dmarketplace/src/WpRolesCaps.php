<?php

namespace DMarketPlace;

use DMarketPlace\Framework\Utils\SellerUtil;
use DMarketPlace\Translator;

/**
 * Description of WpRolesCaps
 *
 * @author Hubsine
 */
class WpRolesCaps {
    
    public $translator;
    
    public function __construct(Translator $translator) {
        
        $this->translator = $translator;
        $this->addRoles();
        
        #add_action('init', array($this, 'add_roles'));
    }
    
    public function addRoles(){
        
//        add_role(
//            SellerUtil::ROLENAME_PENDING_EMAIL, 
//            $this->translator->trans('seller.display_role_name.email', array(), 'messages'), 
//            array()
//        );
//        
//        add_role(
//            SellerUtil::ROLENAME_PENDING_VALIDATION, 
//            $this->translator->trans('seller.display_role_name.admin', array(), 'messages'), 
//            array()
//        );
        
        add_role(
            \SellerUtil::ROLENAME_SELLER, 
            $this->translator->trans('seller.display_role_name.seller', array(), 'messages'), 
            array(
                'edit_published_posts' => true,
                'upload_files' => true,
                'publish_posts' => true,
                'delete_published_posts' => true,
                'edit_posts' => true,
                'delete_posts' => true,
                'read' => true
                // On part du pricipe que par defaut la valeur est à false
                #'delete_others_pages' => false
                #delete_others_posts => false 
                )
            );
        
    }
    
}
