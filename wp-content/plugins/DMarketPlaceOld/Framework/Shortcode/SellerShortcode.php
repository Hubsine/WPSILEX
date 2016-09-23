<?php

namespace DMarketPlace\Framework\Shorcode;

use DMarketPlace\Framework\Form\SellerRegisterType;
use DMarketPlace\Framework\Entity\Seller;

/**
 * Description of SellerShortcode
 *
 * @author nsi
 */
class SellerShortcode{
    

    public function __construct() {
        
        add_shortcode( 'seller_register_form', array( $this, 'display_register_form' ) );
    }
    
    public function display_register_form($atts){
        
        global $app;
        
        $seller = new Seller();
        
        $seller->setUsername('Hipopeur');
        //$seller->setLastName('Diallo');
        //$seller->setFirstName('Mouhamadou');
        
        $form = $app['form.factory']->createBuilder(SellerRegisterType::class, $seller)->getForm();
        
        //$template = $app['twig']->loadTemplate(PLUGIN_DIR.'/views/forms/seller_register_form.html.twig');
        
       

//        return $app['twig']->render('foundation_5_layout.html.twig', array(
//            'form' => $form->createView(),
//            'attr' => array(),
//            'method' => 'POST',
//            'action' => '#',
//            'name'  => 'seller_register',
//            'multipart' => false,
//            'label' => 'Form',
//            'label_attr' => array()
//                )
//                );
        return $app['twig']->render('@DMarketPlaceViewsForms'.'/seller_register_form.html.twig', array('form' => $form->createView()));
    }
}

