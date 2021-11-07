<?php

namespace Synext\Exceptions;


/**
 * [Description DebugTrait] Show http error if App debug is set to false
 */
trait DebugTrait
{
    function http_error_page(int $status_code)
    {
        if (!DEBUG) {
            $error_page = "to" . $status_code . "page";
            $error_page();
        }
    }
}
