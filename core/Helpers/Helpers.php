<?php 
namespace App\Helpers;

use Exception;

class Helpers{

    public static function checkFile($file_name){
        $file_size_max = 3097152;
        $file_type = ['jpg', 'png', 'jpeg'];
        $file_info = $_FILES[$file_name];
        $file_ext = strtolower(substr(strchr($file_info['name'], '.'), 1));
        if($file_info['size'] <= $file_size_max) {
            if (in_array($file_ext, $file_type)) {
                return $file_ext;
            }
        }
        return false;
    }
    public static function uploadFile($file_name,$path){
        $file_info = $_FILES[$file_name];
        if(!file_exists($path)){
            try{
                move_uploaded_file($file_info['tmp_name'], $path);
                return true;
            }catch(Exception $e){
                //
            }
        }
    }
    public static function getExtrait(string $content, int $limit = 12)
    {
        if (strlen($content) <= $limit) {
            return $content;
        }

        return substr($content, 0, $limit).'..';
    }
}

