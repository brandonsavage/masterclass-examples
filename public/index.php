<?php

session_start();

$path = realpath(__DIR__ . '/..');

require_once $path . '/vendor/autoload.php';

// Services need to be objects, so let's use a Closure object.
$config = function() use ($path) {
    return require ($path . '/config/config.php');
};

$configuration = require $path . '/config/config.php';

$diContainerBuilder = new Aura\Di\ContainerBuilder();
$di = $diContainerBuilder->newInstance(['config' => $config], $configuration['config_classes']);


$framework = $di->newInstance('Masterclass\FrontController\MasterController');
echo $framework->execute();