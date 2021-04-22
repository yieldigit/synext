<?php 
namespace Synext\Helpers;

use Exception;
use DateTime;
class Helpers{

    public static function checkFile($file_name,$file_size,array $file_type){
        $file_size_max = 3097152;
        //3097152
        $file_ext = strtolower(substr(strchr($file_name, '.'), 1));
        if($file_size <= $file_size_max) {
            if (in_array($file_ext, $file_type)) {
                return $file_name;
            }
        }
        return false;
    }
    public static function uploadFile($file_name,$tempfile,$path){
        if($file_name){
            if(!file_exists($path)){
                try{
                    move_uploaded_file($tempfile, $path);
                    return true;
                }catch(Exception $e){
                    //
                    throw new Exception('ERROR UPLOADS');
                }
            }
        }

    }
    public static function uploadsFile($file_name,$file_size,array $file_type,$file_tmp,$destination){

        $file_name = self::checkFile($file_name,$file_size,$file_type);
        $path = $destination.$file_name;
        $upload = self::uploadFile($file_name,$file_tmp,$path);
        $name = explode('.',$file_name)[0];
        return [$upload,$name,$file_name];
    }

    public static function getExtrait(string $content, int $limit = 12)
    {
        if (strlen($content) <= $limit) {
            return $content;
        }

        return substr($content, 0, $limit).'..';
    }
    
    public static function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);
    
        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;
    
        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }
    
        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }
}

