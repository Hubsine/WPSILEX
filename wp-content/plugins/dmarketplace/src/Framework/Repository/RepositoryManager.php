<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DMarketPlace\Framework\Repository;

use DMarketPlace\Framework\Repository\BaseRepository;
use Symfony\Component\Debug\Exception\ClassNotFoundException;

/**
 * Description of RepositoryManager
 *
 * @author nsi
 */
class RepositoryManager {
    
    /**
     * Unique BaseRepository for all repository
     */
    private $baseRepository;
    
    public function __construct(BaseRepository $baseRepository) {
        
        $this->baseRepository = $baseRepository;
        
    }

        /**
     * 
     * Construit une instance de RepositoryInterface avec en paramère le service BaseRepository
     * 
     * @param String $repositoryName
     */
    public function getRepository($repositoryName){

        try {
            
            $class = 'DMarketPlace\Framework\Repository\\'.$repositoryName.'Repository';
            
            if(class_exists($class)){
                return $repo = new $class();
                #return $baseRepo = $repo->setBaseRepository($this->baseRepository);
            }
                    
            throw new \Exception('Class not found');
            
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }

    }
    
}
