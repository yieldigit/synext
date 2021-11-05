<?php

use Synext\Helpers\HtmlMetaTagHeader;

function htmlmetatagheader($title, $description, $keywords, $image = null)
{
    return (new HtmlMetaTagHeader($title, $description, $keywords, $image));
}
