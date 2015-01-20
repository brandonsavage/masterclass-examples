<?php

$di = new Aura\Di\Container(new Aura\Di\Factory());

$db = $config['database'];

$dsn = 'mysql:host=' . $db['host'] . ';dbname=' . $db['name'];

$di->params['PDO'] = [
    'dsn' => $dsn,
    'username' => $db['user'],
    'passwd' => $db['pass'],
];

$di->params['Masterclass\Model\Comment'] = [
    'pdo' => $di->lazyNew('PDO')
];

$di->params['Masterclass\Model\Story'] = [
    'pdo' => $di->lazyNew('PDO'),
];

$di->params['Masterclass\FrontController\MasterController'] = [
    'container' => $di,
    'config' => $config,
];

$di->params['Masterclass\Controller\Comment'] = [
    'commentModel' => $di->lazyNew('Masterclass\Model\Comment'),
];

$di->params['Masterclass\Controller\Story'] = [
    'storyModel' => $di->lazyNew('Masterclass\Model\Story'),
    'commentModel' => $di->lazyNew('Masterclass\Model\Comment'),
];

$di->params['Masterclass\Controller\Index'] = [
    'storyModel' => $di->lazyNew('Masterclass\Model\Story'),
];

$di->params['Masterclass\Controller\User'] = [
    'config' => $config,
];