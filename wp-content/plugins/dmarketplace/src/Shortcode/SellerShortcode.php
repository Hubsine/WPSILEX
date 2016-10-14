<?php

namespace DMarketPlace\Shortcode;

use DMarketPlace\Framework\Form\Type\SellerRegisterType;
use DMarketPlace\Framework\Entity\Seller;
use DMarketPlace\Framework\Form\FormFactory;
use DMarketPlace\Framework\Twig\Twig;
use DMarketPlace\Shortcode\BaseShortcode;
use DMarketPlace\Framework\Controller\BaseController;
use DMarketPlace\Framework\Controller\Resolver\ControllerResolver;
use DMarketPlace\Init;
use DMarketPlace\Framework\Model\SellerInterface;

/**
 * Description of SellerShortcode
 *
 * @author nsi
 */
class SellerShortcode extends BaseShortcode{
    
    public $sellerController;

    public function __construct(ControllerResolver $controllerResolver) {
       
        parent::__construct($controllerResolver);
       
        add_shortcode( 'seller_register_form', array( $this, 'display_seller_register_form' ) );
        add_shortcode( 'check_register_email', array($this, 'check_register_email' ) );
    }
    
    public function display_seller_register_form($atts){
 
        $sellerController = $this->controllerResolver->getController(Init::$request);

        return $sellerController[0]->createAction();
        
    }
    
    public function check_register_email(){
        return 'check email page';
    }
}

