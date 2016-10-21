<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Util{
    
    const META_KEY_CONFIRMATION_EMAIL_TOKEN = 'dm-confirmation-email-token-%s';
    const ADMIN_TRANS_DOMAIN = 'admin';
    
    public static function getReduxOption($optionId){
        return \Redux::getOption(DM_OPT_NAME, $optionId);
    }
    
    public static function generateEmailConfirmationToken(){
        return md5(uniqid(rand(), true));
    }

    public static function getConfirmationPage(){
        return self::getReduxOption('dm-check-email-page');
    }

    public static function generateConfirmationUrl(\WP_User $user){
        
        $pageId = self::getConfirmationPage();

        if(empty($pageId)){ 
            throw \DmErrors::requiredAValue(\DmMessages::$requiredAValue, 'dm-check-email-page', "Voir la doc http://hubsine.com/doc");
        }
        
        $metaKey = sprintf(self::META_KEY_CONFIRMATION_EMAIL_TOKEN, $user->ID);
        $token = get_user_meta($user->ID, $metaKey, true);
        
        if(empty($token)){
            $token = self::generateEmailConfirmationToken();
            add_user_meta($user->ID, $metaKey, $token, true);
        }{
            update_user_meta($user->ID, $metaKey, $token);
        }
              
        $confirmationUrl = get_permalink($pageId).'?dm-confirmation-email-token='.$token;
        
        return $confirmationUrl;
    }
    
    public static function getSwiftTransport(){
        
        $transportOption = self::getReduxOption('dm-mailer-transport');
        
        switch ($transportOption){

            case 'smtp':
                
                $host = self::getReduxOption('dm-smtp-smtp');
                $port = self::getReduxOption('dm-smtp-port');
                $security = self::getReduxOption('dm-smtp-security');
                $username = self::getReduxOption('dm-smtp-username');
                $password = self::getReduxOption('dm-smtp-password');

                $transport = \Swift_SmtpTransport::newInstance($host, $port, $security);
                $transport->setUsername($username);
                $transport->setPassword($password);
                #$transport->setAuthMode('login');
                
                break;
            
            case 'sendmail':
                $command = self::getReduxOption('dm-sendmail-command');
                $transport = \Swift_SendmailTransport::newInstance($command);
                break;
            
            default :
                $transport = Swift_MailTransport::newInstance();
        }
        
        return $transport;
    }
    
}

