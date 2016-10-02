<?php

namespace DMarketPlace\Framework\Repository;

use DMarketPlace\Framework\Repository\BaseRepository;
use DMarketPlace\Framework\Repository\RepositoryInterface;
use DMarketPlace\Framework\Entity\Seller;
use DMarketPlace\Framework\Form\Type\SellerRegisterType;
use Symfony\Component\Form\FormInterface;
use DMarketPlace\Framework\Debug\Errors;
use DMarketPlace\Framework\Debug\FormError;
use DMarketPlace\Framework\Debug\Messages;

/**
 * Description of SellerRepository
 *
 * @author nsi
 */
class SellerRepository extends BaseRepository{
    
    public function createSeller(FormInterface $form){

        $isSeller = ($form->getData() instanceof Seller) ? true : false;

        if(null === $isSeller){
            throw Errors::classInstanceOfError(sprintf(Messages::$classInstanceOf, Seller::class, SellerRegisterType::class));
        }
        
        $wpUser = wp_insert_user($form->getData());
        #$wpUser = false; # A supprimer, c'etait juste pour le test
        
        if($wpUser instanceof \WP_Error){
            
            $wpErrorCode = $wpUser->get_error_code();
            $formError = FormError::addWpError($wpUser);
            
            switch ($wpErrorCode){
                
                case 'existing_user_login':
                    $form->get('user_login')->addError($formError);
                    break;
                
                case 'existing_user_email': 
                    $form->get('user_email')->addError($formError);
                    break;
            }
            
        }else{
            if(is_int($wpUser)) $form->getData ()->ID = $wpUser;
        }
        
        return $form;
    }
}
