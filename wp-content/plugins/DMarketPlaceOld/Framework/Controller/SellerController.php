<?php

namespace DMarketPlace\Framework\Controller;

use DMarketPlace\Framework\Repository\SellerRepository;

/**
 * Description of SellerController
 *
 * @author nsi
 */
class SellerController {
    
    protected $repo;
    
    public function __construct(SellerRepository $repository) {
        $this->repo = $repository;
    }

    public function createAction(){
        echo 'createAction';
    }
}
