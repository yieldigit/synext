<?php 
namespace Synext\API;

class Http{
    public static function  methods(string $request_method): bool{
        if($_SERVER['REQUEST_METHOD'] === $request_method){
            return true;
        }
        return false;
    }
    public static function _header(string $status_code){

    }
}