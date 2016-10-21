<?php

namespace DMarketPlace\Framework\Controller;

use DMarketPlace\Framework\Controller\BaseController;
use DMarketPlace\Framework\Traits\SellerController as SellerControllerTrait;
use DMarketPlace\Framework\Repository\SellerRepository;
use DMarketPlace\Framework\Form\Type\SellerRegisterType;
use DMarketPlace\Framework\Entity\Seller;
use DMarketPlace\Framework\Entity\UserMeta;
use DMarketPlace\Framework\Form\Constraints\UserMetaConstraint;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormError;
use DMarketPlace\Init;

/**
 * Description of SellerController
 * 
 * WP Page 
 *  - Seller register => contient le shortcode qui gère le formulaire d'inscription d'un vendeur
 *  - Confirmation url => Contient le shortcode qui gère la confirmation d'un email 
 *
 * @author nsi
 */
class SellerController extends BaseController{
    
    use SellerControllerTrait;
    
    public function createAction(){

        $seller = new Seller();
        $seller->user_pass = wp_generate_password(8, TRUE);
        $seller->roles(array(\SellerUtil::ROLENAME_SELLER));
        $seller->nickname = 'Hipopeurr';
        $seller->user_email = 'shonen.shojo@gmail.com';
        $seller->ID = 987;
        
        $form = $this->createBuilderForm(SellerRegisterType::class, $seller)->getForm();
       
        $request = Init::$request;
        $form->handleRequest($request);

        #echo count($form->getErrors(true));
        
        if(!$form->isValid() /*&& $request->isMethod('POST')*/){
          
            // A decomenter pour pouvoir inserer le user dans la bdd
            $em = $this->get('repository.manager');
            $repo = $em->getRepository(\SellerUtil::REPOSITORY_CLASS);
            //$repo->createSeller($form);
            
            if(!$form->isValid()){
                
                $success = $this->createRegisterMetas($seller);
                
                // Enlever le !== (utiliser pour le test) et mettre ===
                if(true !== $success){
                   
                    $send = $this->sendCheckEmail($seller);
                    var_dump($send);
                    
                }else{
                    
                    $form->addError($success);
                    $em->deleteUser($seller);
                    
                }
            }
        }
       
        $formTwig = \SellerUtil::getRegisterFormName();
        
        #@DMarketPlace:Forms/seller_register_form.html.twig
        return $this->renderView('@DMarketPlace:Forms/'.$formTwig, array('form' => $form->createView()));
        
    }
    
    public function readAction(){
        return 'readAction';
    }
    
}
