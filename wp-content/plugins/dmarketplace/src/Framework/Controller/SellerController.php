<?php

namespace DMarketPlace\Framework\Controller;

use DMarketPlace\Framework\Controller\BaseController;
use DMarketPlace\Framework\Repository\SellerRepository;
use DMarketPlace\Framework\Form\Type\SellerRegisterType;
use DMarketPlace\Framework\Entity\Seller;
use DMarketPlace\Framework\Entity\UserMeta;
use DMarketPlace\Framework\Form\Constraints\UserMetaConstraint;
use DMarketPlace\Framework\Utils\SellerUtil;
use Symfony\Component\HttpFoundation\Request;
use DMarketPlace\Init;

/**
 * Description of SellerController
 *
 * @author nsi
 */
class SellerController extends BaseController{
    
    protected $repo;
    
    public function createAction(){
        
        $seller = new Seller();
        $seller->user_pass = wp_generate_password(8, TRUE);
        $seller->roles(array(SellerUtil::ROLENAME_SELLER));
        
        $form = $this->createBuilderForm(SellerRegisterType::class, $seller)->getForm();
       
        $request = Init::$request;
        $form->handleRequest($request);

        //$repo->getRepository('Seller');
        if(!$form->isValid()){
            
            // A decomenter pour pouvoir inserer le user dans la bdd
            //$repo = $this->get('repository.manager')->getRepository('Seller');
            //$repo->createSeller($form);
            
            if(!$form->isValid()){
                
                $userId = $form->getData()->ID;
                $userMetaConstraint = new UserMetaConstraint();
                
                $sellerMeta1 = new UserMeta(
                    array(
                        'user_id' => $userId,
                        'meta_key' => SellerUtil::META_KEY_SELLER_STATUS,
                        'meta_value' => SellerUtil::META_VALUE_PENDING_EMAIL_VALIDATION
                    )
                );
                $sellerMeta2 = new UserMeta(
                    array(
                        'user_id' => $userId,
                        'meta_key' => SellerUtil::META_KEY_ACTIVATION_EMAIL,
                        'meta_value' => SellerUtil::getEmailConfirmationToken()
                    )
                );
                
                $validator = $this->get('validator');
                
                if($violations = $validator->validate($sellerMeta1, $userMetaConstraint->user_id)){
                    var_dump($violations);
                }
                
                // Ajout du status du seller en "Attente de la validation de l'email"
              
                // Créer la vue avec twig 
                
            }
            
        }
       
        return $this->renderView('@DMarketPlace:Forms/seller_register_form.html.twig', array('form' => $form->createView()));
        
    }
    
    public function readAction(){
        return 'readAction';
    }
}
