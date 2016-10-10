<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DMarketPlace\Framework\Repository;

use DMarketPlace\Framework\Repository\BaseRepository as _BaseRepository;
use DMarketPlace\Framework\Repository\RepositoryInterface;
use DMarketPlace\Framework\Entity\UserMeta;

/**
 * Description of BaseRepository
 *
 * @author nsi
 */
class BaseRepository implements RepositoryInterface{
    
    public $wpdb;
    public $tablePrefix;

    public function __construct(){
        
        global $wpdb;
        
        $this->wpdb = $wpdb;
        $this->tablePrefix = $wpdb->base_prefix;
       
    }
    
    public function find($id){
        
    }
    
    public function findAll(){
        
    }
    
    public function findBy($criteria){
        
    }
    
    public function findOneBy($criteria){
        
    }
    
    public function deleteUser($userId){
        
        #$this->wpdb->delete(USER_TABLE, array('ID' => $userId));
        return $response = $this->wpdb->query( 
            $this->wpdb->prepare( 
		"
                DELETE FROM ".$this->wpdb->users."
		WHERE ID = %d
		",
	        $userId 
            )
        );
        
    }

    public function deleteBy($table, array $where, $whereFormat = null){
        
        $this->wpdb->delete( $table, $where, $where_format = null );
        
    }

    public function insertUserMeta($metas){
        
        if(is_array($metas)){
            foreach ($metas as $key => $userMeta) {
                if($userMeta instanceof UserMeta){
                    add_user_meta($userMeta->user_id, $userMeta->meta_key, $userMeta->meta_value);
                }
            }
        }
        
        if($metas instanceof UserMeta){
            add_user_meta($metas->user_id, $metas->meta_key, $meta->meta_value);
        }
    }
    
}
