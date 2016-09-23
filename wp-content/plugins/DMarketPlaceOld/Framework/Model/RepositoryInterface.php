<?php

namespace DMarketPlace\Framework\Model;

interface RepositoryInterface{
    
    public function find($id);
    
    public function findAll();
    
    public function findBy($criteria);
    
    public function findOneBy($criteria);
}
