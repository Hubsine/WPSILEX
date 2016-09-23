<?php

namespace DMarketPlace\Framework\Controller\Resolver;

use Symfony\Component\HttpKernel\Controller\ControllerResolver as BaseControllerResolver;
use DMarketPlace\DependencyInjection\Container;

class ControllerResolver extends BaseControllerResolver{
    
    public $container;
    
    public function __construct(Container $container) {
        $this->container = $container;
    }
    
    /**
     * Returns an instantiated controller.
     * 
     * Chaque controller possède le container
     *
     * @param string $class A class name
     *
     * @return object
     */
    protected function instantiateController($class)
    {
        return new $class($this->container);
    }
    
}