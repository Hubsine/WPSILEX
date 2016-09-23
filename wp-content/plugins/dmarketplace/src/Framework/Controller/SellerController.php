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
        //$seller->setUsername('Hipopeur');
        $seller->setLastName('Diallo');
        //$seller->setFirstName('Mouhamadou');
        
        $form = $this->createBuilderForm(SellerRegisterType::class, $seller)->getForm();
       
        $request = Init::$request;
        $form->handleRequest($request);

        #$violations = $this->validate($seller);
        $repo = $this->get('repository.manager')->getRepository('Seller');

        //$repo->getRepository('Seller');
        if($form->isValid()){
            var_dump($form->getData());
            //return 'sucess';
        }
       
        return $this->renderView('seller_register_form.html.twig', array('form' => $form->createView()));
        
    }
    
    public function readAction(){
        return 'readAction';
    }
}
