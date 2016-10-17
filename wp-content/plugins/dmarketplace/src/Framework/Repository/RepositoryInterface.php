<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DMarketPlace\Framework\Repository;

/**
 * Description of RepositoryInterface
 *
 * @author nsi
 */
interface RepositoryInterface {
    
    public function find($id);
    
    public function findAll();
    
    public function findBy($criteria);
    
    public function findOneBy($criteria);
    
    public function deleteBy($table, array $where, $whereFormat = null);
    
    public function insertUserMeta($metas);
    
    public function insert($entity);
}
