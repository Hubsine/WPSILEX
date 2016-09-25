<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DMarketPlace\Framework\Debug;

use Symfony\Component\Form\FormError as SyFormError;

/**
 * Description of FormError
 *
 * @author Hubsine
 */
class FormError{

    public static function addWpError(\WP_Error $wpError){
        
        return new SyFormError($wpError->get_error_message());
    }
}
