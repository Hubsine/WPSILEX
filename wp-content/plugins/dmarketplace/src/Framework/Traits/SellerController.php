<?php

namespace DMarketPlace\Framework\Traits;

use DMarketPlace\Framework\Utils\SellerUtil;
use DMarketPlace\Framework\Debug\Errors;
use DMarketPlace\Framework\Debug\Messages;
use DMarketPlace\Framework\Entity\Seller;

/**
 * Description of SellerController
 *
 * @author Hubsine
 */
trait SellerController {
    
    protected function generateConfirmationUrl(Seller $seller){
        
        $pageId = SellerUtil::getConfirmationPage();

        if(empty($pageId)){ 
            throw Errors::requiredAValue(Messages::$requiredAValue, 'dm-check-email-page', "Voir la doc http://hubsine.com/doc");
        }
        
        $token = SellerUtil::generateEmailConfirmationToken();
        $metaKey = sprintf(SellerUtil::META_KEY_CONFIRMATION_EMAIL_TOKEN, $seller->ID);
        
        add_user_meta($seller->ID, $metaKey, $token, true);
        
        $url = get_permalink($pageId).'?dm-confirmation-email-token='.$token;
        
        $confirmationUrl = sprintf( '<a href="%s">%s</a>', $url, $url );
        
        return $confirmationUrl;
        
    }
    
}
