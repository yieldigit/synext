<?php

namespace Synext\Components\Htmls;

class Header
{
    private $url;
    private $logo;
    private $logo_type;
    private $creator;
    private $description;
    private $title;
    private $keywords;
    private $facebok_page_name;
    private $facebok_page_id;

    public function __construct(string $url = null,string $title = null,string $logo = null,string $logo_type = null,string $creator = null,string $description = null,string $keywords = null,string $facebok_page_name=null, string $facebok_page_id=null)
    {
        $this->url = $url;
        $this->logo = $logo;
        $this->logo_type = $logo_type;
        $this->creator = $creator;
        $this->description = $description;
        $this->title = $title;
        $this->keywords = $keywords;
        $this->facebok_page_name = $facebok_page_name;
        $this->facebok_page_id = $facebok_page_id;
    }

    public function showHeader(): string
    {
        return $this->title()."\n".$this->htmlHeader()."\n".$this->facebookHeader()."\n".$this->twiterHeader();
    }

    private function title()
    {
        return '<title>'.$this->title.'</title>';
    }

    private function twiterHeader()
    {
        return '<meta name="twitter:card" content="sommaire">
        <meta name="twitter:url" content="'.$this->url.'">
        <meta name="twitter:creator" content="@'.$this->creator.'" />
        <meta name="twitter:title" content="'.$this->title.'">
        <meta name="twitter:description" content="'.$this->description.'">
        <meta name="twitter:image" content="'.$this->logo.'">';
    }

    private function facebookHeader()
    {
        return '<meta property="og:title" content="'.$this->title.'">
        <meta property="og:type" content="website" />
        <meta property="og:title" content="'.$this->title.'" />
        <meta property="og:description" content="'.$this->description.'">
        <meta property="og:image" content="'.$this->logo.'" />
        <meta property="og:image:type" content="'.$this->logo_type.'" />
        <meta property="og:image:width" content="1200" />
        <meta property="og:image:height" content="630" />
        <meta property="og:url" content="'.$this->url.'" />
        <meta property="og:site_name" content="'.$this->facebok_page_name.'" />
        <meta property="fb:page_id" content="'.$this->facebok_page_id.'" />';
    }

    private function htmlHeader()
    {
        return '<meta name="author" content="'.$this->creator.'">
        <meta property="og:title" content="'.$this->title.'" />
        <meta property="og:description" content="'.$this->description.'" />
        <meta property="og:image" content="'.$this->logo.'" />
        <meta name="keywords" content="'.$this->keywords.' ">
        <meta property="og:url" content="'.$this->url.'" />';
    }
}
