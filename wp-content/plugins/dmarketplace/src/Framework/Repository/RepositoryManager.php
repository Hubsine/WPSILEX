<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DMarketPlace\Framework\Repository;

use DMarketPlace\Framework\Repository\BaseRepository;
use DMarketPlace\Framework\Mapping\MappingAnnotationManager;
use Symfony\Component\Debug\Exception\ClassNotFoundException;
use DMarketPlace\Framework\Repository\RepositoryInterface;
#use DMarketPlace\Framework\Debug\Errors;
#use DMarketPlace\Framework\Debug\Messages;

/**
 * Description of RepositoryManager
 *
 * @author nsi
 */
class RepositoryManager implements RepositoryInterface{
    
    /**
     * Unique BaseRepository for all repository
     */
    public $wpdb;
    public $tablePrefix;
    
    #public $annotationManager;


    public function __construct() {
        
        global $wpdb;
        
        $this->wpdb = $wpdb;
        $this->tablePrefix = $wpdb->base_prefix;
        
        #$this->annotationManager = $annotationManager;
        
    }

    /**
     * 
     * Construit une instance de RepositoryInterface avec en paramère le service BaseRepository
     * 
     * @param String $repositoryName
     */
    public function getRepository($repositoryClass){

        try {
            
            #$class = 'DMarketPlace\Framework\Repository\\'.$repositoryName.'Repository';
            
            if(class_exists($repositoryClass)){
                $repo = new $repositoryClass();
                $repo->_em = $this;
                return $repo;
                #return $baseRepo = $repo->setBaseRepository($this->baseRepository);
            }
                    
            throw \DmErrors::classNotFound(\DmMessages::$classNotFound, $repositoryClass);
            
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }

    }
    
    public function find($id){
        
    }
    
    public function findAll(){
        
    }
    
    public function findBy($criteria){
        
    }
    
    public function findOneBy($criteria){
        
    }
    
    public function deleteUser(\WP_User $user){
        
        $this->wpdb->query( 
            $this->wpdb->prepare( 
		"
                DELETE FROM ".$this->wpdb->users."
		WHERE ID = %d
		",
	        $user->ID
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
            add_user_meta($metas->user_id, $metas->meta_key, $metas->meta_value);
        }
    }
    
    public function insert($entity){
        
    }
    
}
