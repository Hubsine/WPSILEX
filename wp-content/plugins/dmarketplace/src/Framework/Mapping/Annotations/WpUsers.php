<?php

namespace DMarketPlace\Framework\Annotations;

use Doctrine\Common\Annotations\Annotation;


/**
 * Description of WpUsers
 * 
 * @Annotation
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
 *
 * @author Hubsine
 */
class WpUsers{
    
    const TABLE_NAME = 'wp_users';
    
  

    /**
     *si le var n'est pas un string, une exception est levé : array<integer> 
     * @var string
     * @Required
     * 
     * Enum est les valeurs accpeté par le champ 
     * Enum({"user_login", "user_pass", "user_nicename", "user_email", "user_status", "display_name"})
     */
    public $column;
}
