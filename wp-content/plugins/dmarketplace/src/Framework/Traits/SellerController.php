<?php

namespace DMarketPlace\Framework\Traits;

#
use DMarketPlace\Framework\Entity\Seller;

/**
 * Description of SellerController
 *
 * @author Hubsine
 */
trait SellerController {
    
    protected function generateConfirmationUrl(Seller $seller){
        
        $pageId = \Util::getConfirmationPage();

        if(empty($pageId)){ 
            throw Errors::requiredAValue(Messages::$requiredAValue, 'dm-check-email-page', "Voir la doc http://hubsine.com/doc");
        }
        
        $token = \Util::generateEmailConfirmationToken();
        $metaKey = sprintf(\Util::META_KEY_CONFIRMATION_EMAIL_TOKEN, $seller->ID);
        
        add_user_meta($seller->ID, $metaKey, $token, true);
        
        $url = get_permalink($pageId).'?dm-confirmation-email-token='.$token;
        
        $confirmationUrl = sprintf( '<a href="%s">%s</a>', $url, $url );
        
        return $confirmationUrl;
        
    }
    
}
