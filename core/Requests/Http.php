<?php 
namespace Synext\Requests;

class Http{
    public static function  methods(string $request_method): bool{
        if($_SERVER['REQUEST_METHOD'] === $request_method){
            return true;
        }
        return false;
    }
    public static function status(int $status_code=200){
        return http_response_code($status_code);
    }
}