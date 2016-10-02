<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DMarketPlace\Framework\Utils;

class Util{
    
    public static function getEmailConfirmationToken(){
        return md5(uniqid(rand(), true));
    }

}

