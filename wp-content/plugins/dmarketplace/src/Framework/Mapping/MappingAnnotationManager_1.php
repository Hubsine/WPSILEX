<?php

namespace DMarketPlace\Framework\Mapping;

use Doctrine\Common\Annotations\AnnotationRegistry;

/**
 * Description of MappingAnnotationManager
 *
 * @author nsi
 */
class MappingAnnotationManager {

    public function __construct(){
        
        AnnotationRegistry::registerAutoloadNamespace(
                'Framework/Mapping/Annotations',
                DM_FRAMEWORK_DIR
                );
    }
    
}
