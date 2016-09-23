<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DMarketPlace\Shortcode;

use DMarketPlace\Framework\Controller\Resolver\ControllerResolver;

/**
 * Description of BaseShortcode
 *
 * @author nsi
 */
class BaseShortcode {
    
    public $controllerResolver;
    
    public function __construct(ControllerResolver $controllerResolver) {
        
        $this->controllerResolver = $controllerResolver;
        
    }
}
