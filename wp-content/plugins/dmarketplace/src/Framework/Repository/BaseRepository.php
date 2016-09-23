<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DMarketPlace\Framework\Repository;

use DMarketPlace\Framework\Repository\BaseRepository as _BaseRepository;

/**
 * Description of BaseRepository
 *
 * @author nsi
 */
class BaseRepository {
    
    public function setBaseRepository(_BaseRepository $baseRepository){
        
        return self::$_instance = $baseRepository;
    }
}
