<?php

namespace DMarketPlace\Framework\Traits;

trait DmActionEntity {
    
    protected $dm_action;
    
    public function getDmAction(){
        return $this->dm_action;
    }
    
    public function setDmAction($dmAction){
        
        $this->dm_action = $dmAction;
        
        return $this;
        
    }
    
}
