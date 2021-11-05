<?php

use Synext\Requests\Http;
use Synext\Requests\Json;
use Synext\Validation\validation;



/**
 * Validate data
 * @param array $keys
 * @return [bool]
 */
function validate_input(array $keys)
{
    $data = Json::input();
    $check = validation::validate($keys, $data);
    if ($check) {
        return_json([
            "error" => true,
            "message" => "There errors in your data"
        ]);
    }
    return $data;
}
/**
 * Return Json data
 *
 * @param array $data
 * @return void
 */
function return_json(array $data)
{
    exit(Json::to($data));
};
/**
 * Generate random token
 *
 * @param integer $length
 * @return string
 */
function token(int $length): string
{
    $keys = '0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN';

    return uniqid(substr(str_shuffle(str_repeat($keys, $length)), 0, $length));
}

/**
 * Redirect to 400 Page
 *
 * @return void
 */
function to400page()
{
    require_once '../views/errors/400.php';
    Http::status(404);
    die();
}
/**
 * Redirect to 404 Page
 *
 * @return void
 */
function to404page()
{
    require_once '../views/errors/404.php';
    Http::status(404);
    die();
}

/**
 * Redirect to 403 Page
 *
 * @return void
 */
function to403page()
{
    require_once '../views/errors/403.php';
    Http::status(403);
    die();
}
