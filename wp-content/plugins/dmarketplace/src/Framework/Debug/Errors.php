<?php

namespace DMarketPlace\Framework\Debug;

/**
 * Description of Errors
 *
 * @author Hubsine
 */
class Errors extends \Exception {
    
    public static function classInstanceOfError($message){
        return new self($message);
    }
    
}
