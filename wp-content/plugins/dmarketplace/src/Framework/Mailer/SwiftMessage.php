<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DMarketPlace\Framework\Mailer;

use Util;

/**
 * Description of Mailer
 *
 * @author Hubsine
 */
class SwiftMessage extends \Swift_Message{
    
//    private $transport;
//    private $user;
//    private $host;
//    private $password;
    
    private $mailerParam;

    public function __construct() {
        
        
        
//        $this->mailerParam = $mailerParam;
//        
//        foreach ($mailerParam as $key => $value) {
//            $this->mailerParam[key($value)] = array_shift($value);
//        }
        
    }

    public function newMessage($subject = null, $body = null, $contentType = null, $charset = null){

        $from = (!empty(Util::getReduxOption('dm-mailer-from')) ? Util::getReduxOption('dm-mailer-from') : get_option('admin_email') );
        return self::newInstance($subject, $body, $contentType, $charset)
            ->setFrom($from);
    }
    
    public function sendWith(SwiftMessage $message, $transport){
        
        if(in_array($this->mailerParam['transport'], $transport)){
            
        }
    }
    
}
