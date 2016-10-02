<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DMarketPlace\Framework\Entity;

/**
 * Description of SellerMeta
 *
 * @author Hubsine
 */
class UserMeta {

    /**
     *
     * Avaibles meta key (array key) and meta value (array value)
     */
//    public $avaiblesMeta = array(
//        'seller_status' => array(
//            'pending_email_validation', 
//            'pending_admin_validation',
//            'validate'
//        ),
//        'seller_email_activation_status' => ''
//    );
    
    /**
     *
     * @var int user_meta
     */
    public $user_id;
    
    /**
     *
     * @var string user_meta
     */
    public $meta_key;
    
    /**
     *
     * @var string user_meta
     */
    public $meta_value;

    public function __construct(array $metaData) {
        
        $this->user_id = (isset($metaData['user_id'])) ? $metaData['user_id'] : null;
        $this->meta_key = (isset($metaData['meta_key'])) ? $metaData['meta_key'] : null;
        $this->meta_value = (isset($metaData['meta_value'])) ? $metaData['meta_value'] : null;
        
    }
}
