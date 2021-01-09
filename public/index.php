<?php

use Synext\Routers\Router;

require '../vendor/autoload.php';
/** Error handler */
(new \Whoops\Run())->pushHandler(new \Whoops\Handler\PrettyPageHandler())->register();

/**public folder */
$public_paths = DIRECTORY_SEPARATOR.basename($_SERVER['DOCUMENT_ROOT']);
/** global views paths */
$view_paths = DIRECTORY_SEPARATOR.dirname($_SERVER['DOCUMENT_ROOT']).DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR;

/** Router  */
$router = new Router($view_paths,$public_paths);

$router->get('/','default/index')
        //     ->resource(
        //             [['GET','/li','pop',]]
        //     )
    ->run();
