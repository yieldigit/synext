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

$admin = "/admin/";
$user = "/";
$api = "/api/v2/";

$router

    ->get($user,'users/index',"App#Home")

  
    ->get($user."produit",'produits/index')

    ->get($user."produit-[i:id_prod]-[*:slug]",'produits/produit')
        
/**
 * profile/5
 * profile-5
 */
    ////////////////////////ADMIN
        // ->resource([
        //     [methode,route,vue,nomroute],
        // ])
        ->resource([
            ["GET",$api."panier","ajaxs/panier"],
            ["POST",$api."panier","ajaxs/panier"],
            ["DELETE",$api."panier","ajaxs/panier"]
        ])
    ->run();
