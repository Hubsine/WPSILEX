<?php

namespace DMarketPlace\Framework\Traits;

#
use DMarketPlace\Framework\Entity\Seller;
use DMarketPlace\Framework\Entity\UserMeta;
use Symfony\Component\Form\FormError;

/**
 * Description of SellerController
 *
 * @author Hubsine
 */
trait SellerController {
    
    protected function createRegisterMetas(Seller $seller){
        
        $repoManager = $this->get('repository.manager');
        $validator = $this->get('validator');
        $translator = $this->get('translator');
        
        $sellerMeta1 = new UserMeta(
            array(
                'user_id' => $seller->ID,
                'meta_key' => \SellerUtil::META_KEY_SELLER_STATUS,
                'meta_value' => \SellerUtil::META_VALUE_PENDING_EMAIL_VALIDATION
            )
        );
        
        $sellerMeta2 = new UserMeta(
            array(
                'user_id' => $seller->ID,
                'meta_key' => \SellerUtil::META_KEY_ACTIVATION_EMAIL,
                'meta_value' => \Util::generateEmailConfirmationToken()
            )
        );
        
        $violations = count($validator->validate($sellerMeta1)) + count($validator->validate($sellerMeta2));
        
        if( 0 !== $violations){
            
            $repoManager->insertUserMeta(array($sellerMeta1, $sellerMeta2));
            
            return true;
        }
        
        $errorMsg = $translator->trans(
            'add_meta_error', 
            array('%code_error%' => 'sellerController.create.add_meta'), 
            'validators');
        
        return new FormError($errorMsg);
    }
    
    protected function sendCheckEmail(Seller $seller){
        
        $mailer = $this->get('swift.mailer');
        
        $messageSubject = $this->trans(
            'seller.register.email.subject', 
            array('%username%' => $seller->nickname),
            'forms');
         
        $messageBody = $this->renderView(
            '@DMarketPlace:Mails/check_email.html.twig', 
            array(
                'username' => $seller->nickname, 
                'confirmationUrl' => \Util::generateConfirmationUrl($seller)));

        $message = $this->newMessage()
            ->setSubject($messageSubject)
            ->setTo($seller->user_email)
            ->setBody($messageBody);
        
        return $send = $mailer->send($message);    
        
    }
    
}
