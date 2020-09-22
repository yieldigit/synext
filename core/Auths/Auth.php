<?php

namespace App\Auths;

use App\Controllers\User;
use App\Helpers\Redirect;
use App\Helpers\Session;

class Auth
{
    /**
     * Function using to generate random Token for account activation .
     *
     *
     * @param int $length
     *
     * @return string token
     */
    public static function Token(int $length): string
    {
        $keys = '0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN';

        return substr(str_shuffle(str_repeat($keys, $length)), 0, $length);
    }

    public static function isConnect(){
        Session::checkSession();
        if(!isset($_SESSION['Auth'])){
            Redirect::To('/login');
            exit;
        }
    }

    public static function allow(string $role)
    {
        //sql slug role getinfo() roles
        self::isConnect();
        if ((new User)->getRoleById((new User)->getUserById(self::who())->getRole_id())->name === $role) {
            return true;
        }else{
            return false;
        }
    }
    public static function who():int{
        self::isConnect();
        return $_SESSION['Auth'];
    }

}
