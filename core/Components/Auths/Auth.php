<?php

namespace Synext\Components\Auths;

use Synext\Models\Users;

/**
 * [Description Auth] to manage user login and register
 */
class Auth extends Users
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
        return token($length);
    }

    public function login()
    {
    }

    public function register()
    {
    }
}
