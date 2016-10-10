<?php

namespace DMarketPlace;

use Symfony\Component\Translation\Translator as BaseTranslator;
use Symfony\Component\Translation\Loader\YamlFileLoader;
use Symfony\Component\Translation\Loader\XliffFileLoader;
use DMarketPlace\Init;

/**
 * Description of Translator
 *
 * @author Hubsine
 */
class Translator extends BaseTranslator {
    
    #public $translator;
    private $localesTransFolder = array('forms', 'messages', 'validators', 'admin');

    public function __construct($locale) {
        
        parent::__construct($locale);
        #$this = $translator;
        $this->loadTranslations();
    }
    
    public function loadTranslations(){
        
        $localeToLoad = Init::$request->getLocale();
        //$translator = new Translator($localeToLoad);
        $this->addLoader('yaml', new YamlFileLoader());
        $this->addLoader('xlf', new XliffFileLoader());
        
        foreach ($this->localesTransFolder as $key => $domainFolderName) {
                
            $currentFolder = DM_LOCALES_TRANS_DIR.'/'.$domainFolderName;

            if($currentResourceFolder = opendir($currentFolder)){
                while (false !== ($transFile = readdir($currentResourceFolder))) {
                    if(pathinfo($transFile, PATHINFO_EXTENSION) === 'yml'){
                        $ymlTransFile = $currentFolder.'/'.$transFile;
                        $locale = explode('.',pathinfo($ymlTransFile, PATHINFO_FILENAME));

                        if(isset($locale[1])){
                            $this->addResource(
                                    'yaml', 
                                    $ymlTransFile, 
                                    $locale[1], 
                                    strtolower($domainFolderName)
                                    );
                        }
                    }
                    //$translator->addResource('yaml', $translationFile, basename($translationFile));
                }
                closedir($currentResourceFolder);
            }

        }
        
        //Load Symfony Validator Translation       
        $this->addResource(
            'xlf',
            DM_VENDOR_FORM_DIR.'/Resources/translations/validators.'.$localeToLoad.'.xlf',
            $localeToLoad,
            'validators'
        );
        $this->addResource(
            'xlf',
            DM_VENDOR_VALIDATOR_DIR.'/Resources/translations/validators.'.$localeToLoad.'.xlf',
            $localeToLoad,
            'validators'
        );
        
    }
}
