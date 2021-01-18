<?php 
namespace Synext\Requests;
class Redirect{
    /**
     * Redirect to specifique url 
     *
     * @param string $url
     * @return void
     */
    public static function to(string $url){
        header('Location: '.$url);
        exit;
    }

}