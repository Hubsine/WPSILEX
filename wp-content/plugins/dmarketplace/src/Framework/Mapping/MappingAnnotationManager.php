<?php

namespace DMarketPlace\Framework\Mapping;

use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\Common\Annotations\AnnotationReader;

/**
 * Description of MappingAnnotationManager
 *
 * @author nsi
 */
class MappingAnnotationManager {

    public function __construct(){
        
        $this->loadAnnotation();
    }
    
    public function loadAnnotation(){
        #AnnotationReader::addGlobalIgnoredName('WpUsers');       
        
//        if($annotationFolder = opendir(DM_FRAMEWORK_DIR.'/Mapping/Annotations')){
//            #echo DM_FRAMEWORK_DIR.'/Mapping/Annotations';
//            while ( false !== ($annotationFile = readdir($annotationFolder)) ) {
//                if(pathinfo($annotationFile, PATHINFO_EXTENSION) === 'php'){ 
//                    echo DM_FRAMEWORK_DIR.'/Mapping/Annotations/'.$annotationFile;
//                    AnnotationRegistry::registerFile(DM_FRAMEWORK_DIR.'/Mapping/Annotations/'.$annotationFile);
//                }
//            }
//            closedir($annotationFolder);
//        }
        
//        AnnotationRegistry::registerAutoloadNamespace(
//                'Framework\Mapping\Annotations', 
//                DM_SRC_DIR);
        
#        AnnotationRegistry::registerLoader('ComposerAutoloaderInit6c24c9d92f8a663060f301e99ebb982e::loadClassLoader');
    }
    
}
