<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DMarketPlace\Framework\Repository;

use DMarketPlace\Framework\Repository\BaseRepository as _BaseRepository;
use DMarketPlace\Framework\Repository\RepositoryInterface;

/**
 * Description of BaseRepository
 *
 * @author nsi
 */
class BaseRepository implements RepositoryInterface{
    
    /**
     * @deprecated since version number
     * @param _BaseRepository $baseRepository
     * @return type
     */
    public function setBaseRepository(_BaseRepository $baseRepository){
        
        return self::$_instance = $baseRepository;
    }
    
    public function find($id){
        
    }
    
    public function findAll(){
        
    }
    
    public function findBy($criteria){
        
    }
    
    public function findOneBy($criteria){
        
    }
    
   
}
