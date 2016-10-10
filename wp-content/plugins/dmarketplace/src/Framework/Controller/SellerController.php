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
use Symfony\Component\Form\FormError;
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

        if($form->isValid() && $request->isMethod('POST')){
            
            // A decomenter pour pouvoir inserer le user dans la bdd
            $repo = $this->get('repository.manager')->getRepository('Seller');
            //$repo->createSeller($form);
            
            if(!$form->isValid()){
                
                $userId = ($form->getData()->ID === 0) ? null : $form->getData()->ID;
                
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
                $translator = $this->get('translator');
                
                $violationsMeta1 = $validator->validate($sellerMeta1);
                $violationsMeta2 = $validator->validate($sellerMeta2);
                
                if(0 !== count($violationsMeta1 || 0 !== count($violationsMeta2))){
                    
                    $errorMsg = $translator->trans('add_meta_error', array('%code_error%' => 'sellerController.create.add_meta'), 'validators');
                    $form->addError(new FormError($errorMsg));
                    $repo->deleteUser($userId);
                    
//                    $message = $this->get('swift.message')->newMessage()
//                        ->setSubject('test')
//                        ->setTo($form->getData()->user_email)
//                        ->setBody('here twig render view');
                    
                    
                }else{
                    $repo->insertUserMeta(array($sellerMeta1, $sellerMeta2));
                    
                    // Envoi du mail d'activation du mail 
                    
                }
                
                
                
            }
            
        }
       
        echo $formTwig = \Redux::getOption('redux_builder_hubsine', 'forms-seller-register');
        #@DMarketPlace:Forms/seller_register_form.html.twig
        return $this->renderView('@DMarketPlace:Forms/'.$formTwig, array('form' => $form->createView()));
        
    }
    
    public function readAction(){
        return 'readAction';
    }
}
