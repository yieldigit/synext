<?php

use Synext\Helpers\HtmlMetaTagHeader;

/**
 * @param string  $title
 * @param string  $description
 * @param string  $keywords
 * @param null $image
 * 
 * @return string
 */
function htmlmetatagheader($title, $description, $keywords, $image = null)
{
    return (new HtmlMetaTagHeader($title, $description, $keywords, $image));
}

/**
 * get router 
 * @return \Synext\Routers\Router 
 */
function router()
{
    global $router;
    if ($router) {
        return $router;
    }
    throw new RuntimeException("Router is not initial", 0);
}

/**
 * get router params
 * @return array
 */
function getParams()
{
    global $params;
    return $params;
}
