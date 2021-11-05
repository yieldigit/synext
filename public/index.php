<?php

use Synext\Routers\Router;

require '../vendor/autoload.php';

$root_path = DIRECTORY_SEPARATOR . dirname($_SERVER['DOCUMENT_ROOT']);
define('ROOT_PATH', $root_path);

/**load env file  */
(Dotenv\Dotenv::createUnsafeImmutable(ROOT_PATH))->load();

define('DEBUG', strtolower(getenv('APP_DEBUG')) === 'true');

if (DEBUG) {
    /** Error handler */
    (new \Whoops\Run())->pushHandler(new \Whoops\Handler\PrettyPageHandler())->register();
}

/**public folder */
$public_paths = DIRECTORY_SEPARATOR . basename($_SERVER['DOCUMENT_ROOT']);

/** global views paths */
$view_paths = ROOT_PATH . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR;

/** Router  */
$router = new Router($view_paths, $public_paths);


$router

    ->get('/', 'default/index')

    ->run();
