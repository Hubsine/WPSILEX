<?php

namespace DMarketPlace\Framework\Controller;

use DMarketPlace\Framework\Controller\BaseController;
use DMarketPlace\Framework\Repository\SellerRepository;
use DMarketPlace\Framework\Form\Type\SellerRegisterType;
use DMarketPlace\Framework\Entity\Seller;
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
        
        $form = $this->createBuilderForm(SellerRegisterType::class, $seller)->getForm();
       
        $request = Init::$request;
        $form->handleRequest($request);

        //$repo->getRepository('Seller');
        if($form->isValid()){
            
            $repo = $this->get('repository.manager')->getRepository('Seller');
            $repo->createSeller($form);
            
            if($form->isValid()){
                //Send password email
            }
            
        }
       
        return $this->renderView('seller_register_form.html.twig', array('form' => $form->createView()));
        
    }
    
    public function readAction(){
        return 'readAction';
    }
}
