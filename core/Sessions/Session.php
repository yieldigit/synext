<?php

namespace Synext\Sessions;

/**
 * [Description Session] Use to interact with session
 */
class Session
{
    /**
     * Check if session is enable else enable it 
     *
     * @return void
     */
    public static function check()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
    /**
     * Destroy session associat key value or all value
     *
     * @return void
     */
    public static function destroy($key = null)
    {
        self::check();
        if ($key) {
            unset($_SESSION[$key]);
        } else {
            unset($_SESSION);
        }
    }

    /**
     * Get session a guived key value or all value
     *
     * @return mixed
     */
    public static function get($key = null)
    {
        self::check();
        if ($key) {
            return $_SESSION[$key];
        } else {
            return $_SESSION;
        }
    }

    /**
     * Push data to session variable
     * @param mixed $data
     * @return mixed
     */
    public static function push($data)
    {
        //need review
        self::check();
        is_array($data) ? array_map(function ($value) use ($data) {
            $_SESSION[array_search($value, $data)] = $value;
        }, $data) : $_SESSION[] = $data;
    }

    /**
     * Set new session variable with data
     * @param mixed $key
     * @param mixed $value
     * 
     * @return void
     */
    public static function set($key, $value)
    {
        self::check();
        return $_SESSION[$key] = $value;
    }

    public static function checkSessionVariable($key)
    {
        self::check();
        if (isset($_SESSION[$key])) {
            return true;
        }
        return false;
    }
}
