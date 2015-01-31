<?php

namespace Masterclass\FrontController;

use Aura\Di\Container;
use Masterclass\Router\Router;

class MasterController {

    /**
     * @var array
     */
    protected $config;

    /**
     * @var Container
     */
    protected $container;

    /**
     * @var Router
     */
    protected $router;
    
    public function __construct(Container $container, array $config = [], Router $router) {
        $this->config = $config;
        $this->container = $container;
        $this->router = $router;
    }
    
    public function execute() {
        $match = $this->_determineControllers();

        $calling = $match->getRouteClass();
        list($class, $method) = explode(':', $calling);
        $o = $this->container->newInstance($class);
        return $o->$method();
    }
    
    protected function _determineControllers()
    {
        $router = $this->router;
        $match = $router->findMatch();

        if (!$match) {
            throw new \Exception('No route match found!');
        }

        return $match;
    }
    
}