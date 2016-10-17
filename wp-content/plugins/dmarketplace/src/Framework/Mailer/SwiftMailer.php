<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DMarketPlace\Framework\Mailer;

use DMarketPlace\Framework\Mailer\SwiftMessage;

/**
 * Description of SwiftMailer
 *
 * @author Hubsine
 */
class SwiftMailer extends \Swift_Mailer{
    
    public function __construct(\Swift_Transport $transport = null) {
        
        if(null === $transport){
            $transport = new \Swift_MailTransport();
        }
        parent::__construct($transport);
        
        #$this->dm_test_mailer_transport();
        
        //var_dump($re);
        
        #$this->dm_test_mailer_transport();
        
        add_action( 'wp_ajax_dm_test_mailer_transport', array($this, 'dm_test_mailer_transport'));
        #add_action( 'wp_ajax_nopriv_dm_test_mailer_transport', array($this, 'dm_test_mailer_transport'));
    }

    public function dm_test_mailer_transport(){
        
        $dmData = (!empty($_POST['dmMailerData'])) ? $_POST['dmMailerData'] : null ;
        #define('DOING_AJAX', true);
        
        switch ($dmData['transport']){
            
            case 'mail':
                $transport = $this->getTransport();
                break;
            
            case 'smtp':
                
                $host = (!empty($dmData['smtp'])) ? $dmData['smtp'] : null;
                $port = (!empty($dmData['port'])) ? $dmData['port'] : 25;
                $security = (!empty($dmData['security'])) ? $dmData['security'] : null;
                $username = (!empty($dmData['username'])) ? $dmData['username'] : null;
                $password = (!empty($dmData['password'])) ? $dmData['password'] : null;

                $transport = \Swift_SmtpTransport::newInstance($host, $port, $security);
                $transport->setUsername($username);
                $transport->setPassword($password);
                $transport->setAuthMode('login');
                break;
            
            case 'sendmail':
                $command = (!empty($dmData['command'])) ? $dmData['command'] : null;
                $transport = \Swift_SendmailTransport::newInstance($command);
                break;
            
            default:
                $transport = null;
        }
        
        $logger = new \Swift_Plugins_Loggers_ArrayLogger();
        
        if($transport instanceof \Swift_Transport){
           
            try {
                $transport->start();
            } catch (\Swift_TransportException $exc) {

                wp_send_json_error(array(
                    'message' => $exc->getMessage(),
                    'code'    => $exc->getCode()  
                ));
                
            }  catch (\Exception $e){
                wp_send_json_error(array(
                    'message' => $exc->getMessage(),
                    'code'    => $exc->getCode()  
                ));
            }
            
        
            $mailer = self::newInstance($transport);
            $mailer->registerPlugin(new \Swift_Plugins_LoggerPlugin($logger));
           
            $message = SwiftMessage::newInstance('Test email', 'body email');
            $message->setTo($dmData['to']);
            (!empty($dmData['from'])) ? $message->setFrom($dmData['from']) : 'contact@wpsilex.com';
          
            $failedRecipients = array();
            
            try {
                
                $mailer->send($message, $failedRecipients);
                
                wp_send_json_success(array(
                    'message' => 'Successfully ! Test message is send.'
                ));
                
            } catch (\Swift_RfcComplianceException $exc) {
                
                wp_send_json_error(array(
                    'message' => $exc->getMessage(),
                    'code'    => $exc->getCode()
                ));
                
            }  catch (\Exception $e){
                
                wp_send_json_error(array(
                    'message' => $e->getMessage(),
                    'code'    => $e->getCode()
                ));
            }
            
        }
        
        $logger->add('Une erreur est survenue.');
        wp_send_json_error(array('message' => $logger->dump()));
        
    }
    
}
