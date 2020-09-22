<?php 
namespace App\Helpers;
class Session{
    /**
     * Check if session is enable else enable it 
     *
     * @return void
     */
    public static function checkSession(){
        if(session_status() === PHP_SESSION_NONE){session_start();}
    }
}