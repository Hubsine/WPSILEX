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
    
    protected $repo;
    
    use SellerControllerTrait;
    
    public function createAction(){

        $seller = new Seller();
        $seller->user_pass = wp_generate_password(8, TRUE);
        $seller->roles(array(\SellerUtil::ROLENAME_SELLER));
        $seller->nickname = 'Hipopeur';
        $seller->user_email = 'shonen.shojo@gmail.com';
        $seller->ID = 987;
        
        $form = $this->createBuilderForm(SellerRegisterType::class, $seller)->getForm();
       
        $request = Init::$request;
        $form->handleRequest($request);

        if(!$form->isValid() /*&& $request->isMethod('POST')*/){
          
            // A decomenter pour pouvoir inserer le user dans la bdd
            $repo = $this->get('repository.manager')->getRepository(\SellerUtil::REPOSITORY_CLASS);
            //$repo->createSeller($form);
            
            if(!$form->isValid()){
                
                $userId = ($form->getData()->ID === 0) ? null : $form->getData()->ID;
                
                $sellerMeta1 = new UserMeta(
                    array(
                        'user_id' => $userId,
                        'meta_key' => \SellerUtil::META_KEY_SELLER_STATUS,
                        'meta_value' => \SellerUtil::META_VALUE_PENDING_EMAIL_VALIDATION
                    )
                );
                $sellerMeta2 = new UserMeta(
                    array(
                        'user_id' => $userId,
                        'meta_key' => \SellerUtil::META_KEY_ACTIVATION_EMAIL,
                        'meta_value' => \Util::generateEmailConfirmationToken()
                    )
                );
                
                $validator = $this->get('validator');
                $translator = $this->get('translator');
                
                $violationsMeta1 = $validator->validate($sellerMeta1);
                $violationsMeta2 = $validator->validate($sellerMeta2);
                
                
                if(0 !== count($violationsMeta1 || 0 !== count($violationsMeta2))){
                   
                    $errorMsg = $translator->trans('add_meta_error', array('%code_error%' => 'sellerController.create.add_meta'), 'validators');
                    $form->addError(new FormError($errorMsg));
                    $repo->deleteUser($userId);
                  
                    $messageSubject = $translator->trans(
                            'seller.register.email.subject', 
                            array('%username%' => $form->getData()->nickname),
                            'forms');
         
                    $messageBody = $this->renderView(
                            '@DMarketPlace:Mails/check_email.html.twig', 
                            array('username' => $form->getData()->nickname, 'confirmationUrl' => $this->generateConfirmationUrl($form->getData())));
                    
                    $message = $this->newMessage()
                        ->setSubject($messageSubject)
                        ->setTo($form->getData()->user_email)
                        ->setBody($messageBody);
                    
                    // Envoi du mail 
                    
                }else{
                    $repo->insertUserMeta(array($sellerMeta1, $sellerMeta2));
                    
                    // Envoi du mail d'activation du mail 
                    $message = $this->newMessage()
                        ->setSubject('test')
                        ->setTo($form->getData()->user_email)
                        ->setBody('here twig render view');
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
    
    private function sendCheckEmail(){
        
    }
}
