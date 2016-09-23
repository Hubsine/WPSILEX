<?php

// Load Framework Class
foreach ($classToAutoload as $classFolder => $arrayClass) {
    
    if(is_array($arrayClass)){
        foreach ($arrayClass as $keyClass => $className) {
            require_once FRAMEWORK_DIR.'/'.$classFolder.'/'.$className.'.php';
        }
    }
    
}
