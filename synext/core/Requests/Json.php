<?php
namespace Synext\Requests;
class Json{
    /**
     * convert Array to json 
     *
     * @param array $data
     * @return string|false
     */
    public static function to(array $data){
        header('Content-Type: application/json');
        return json_encode($data) ;
    }
    
    public static function input(){
        return json_decode(file_get_contents('php://input'), true);
    }
}