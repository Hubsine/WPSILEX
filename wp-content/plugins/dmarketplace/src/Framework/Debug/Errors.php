<?php

namespace DMarketPlace\Framework\Debug;

/**
 * Description of Errors
 *
 * @author Hubsine
 */
class Errors extends \Exception {
    
    public static function classInstanceOfError($message, $class1, $class2){
        return new self(sprintf($message, $class1, $class2));
    }
    
    public static function requiredAValue($message, $var, $docUrl = ""){
        return new self(sprintf($message, $var, $docUrl));
    }
    
}
