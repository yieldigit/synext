<?php

namespace Synext\Helpers;

class HtmlMetaTagHeader
{
    private  $header;
    public function __construct($title, $description, $keywords, $image = null)
    {
        $this->app_url = getenv('APP_URL');
        $this->app_name = getenv('APP_NAME');
        $this->header = <<<HTML
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <title>{$title}</title>
            <meta name="culture" content="en-EN">
            <meta name="secure-url" content="{$this->app_url}">
            <meta name="keywords" content="{$keywords}">
            <meta name="description" content="{$description}">
            <meta name="author" content="{$this->app_url}">
            <meta name="robots" content="index,follow"/>

            <meta property="og:language" content="en"/>
            <meta property="og:site_name" content="{$this->app_name}">
            <meta property="og:title" content="{$title}">
            <meta property="og:url" content="{$this->app_url}">
            <meta property="og:image" content="{$image}" />
            <meta property="og:description" content="{$description}"/>
            <meta property="fb:page_id" content="" />

            <meta property="twitter:card" content="summary_large_image">
            <meta property="twitter:site" content="@{$this->app_name}">
            <meta property="twitter:creator" content="@{$this->app_name}">
            <meta property="twitter:title" content="{$title}">
            <meta property="twitter:description" content="{$description}">
            <meta property="twitter:image" content="{$image}">
            <link rel="shortcut icon" href="/assets/img/favicon.ico">
            
HTML;
    }

    public function __toString(): string
    {
        return $this->header;
    }
}
