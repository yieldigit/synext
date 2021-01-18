<?php 
namespace Synext\Session;

class Session{
    /**
     * Check if session is enable else enable it 
     *
     * @return void
     */
    public static function check(){
        if(session_status() === PHP_SESSION_NONE){session_start();}
    }
    /**
     * Destroy session associat key value or all value
     *
     * @return void
    */
    public static function destroy($key=null){
        self::check();
        if($key){
            unset($_SESSION[$key]);
        }else{
            unset($_SESSION);
        }
    }

    /**
     * Get session a guived key value or all value
     *
     * @return mixed
    */
    public static function get($key){
        self::check();
        if($key){
            return $_SESSION[$key];
        }else{
            return $_SESSION;
        }
    }
    
    /**
     * Push data to session variable
     * @param mixed $data
     * @return mixed
    */
    public static function push($data){
        self::check();
        is_array($data) ? array_map(function($value) use ($data){$_SESSION[array_search($value,$data)] = $value;},$data) : $_SESSION[] = $data;
    }
}