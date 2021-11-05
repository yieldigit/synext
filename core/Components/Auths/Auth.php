<?php

namespace Synext\Components\Auths;

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


}
