<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DMarketPlace\Framework\Utils;

class Util{
    
    const META_KEY_CONFIRMATION_EMAIL_TOKEN = 'dm-confirmation-email-token-%s';
    
    public static function generateEmailConfirmationToken(){
        return md5(uniqid(rand(), true));
    }

    public static function getConfirmationPage(){
        return self::getReduxOption('dm-check-email-page');
    }

    public static function getReduxOption($optionId){
        
        return \Redux::getOption(DM_OPT_NAME, $optionId);
        
    }
}

