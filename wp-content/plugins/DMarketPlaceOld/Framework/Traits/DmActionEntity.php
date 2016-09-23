<?php

namespace DMarketPlace\Framework\Traits;

trait DmActionEntity {
    
    protected $dmAction;
    
    public function getDmAction(){
        return $this->dmAction;
    }
    
    public function setDmAction($dmAction){
        
        $this->dmAction = $dmAction;
        
        return $this;
        
    }
    
}
