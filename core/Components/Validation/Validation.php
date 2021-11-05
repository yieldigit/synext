<?php

namespace Synext\Validation;

/**
 * [Description validation] Simple Validation data
 * 
 */
class validation
{
    /**
     * Check if the give array key in the first parameter exist 
     * in a data provide by user in the second parameter .
     * @param array $keys
     * @param array $data
     * 
     * @return [bool]
     */
    public static function validate(array $keys, array $data)
    {

        if (count($keys) != count($data)) {
            return true;
        }
        $is_set = function ($key) use ($data, $keys) {
            return array_key_exists($key, $data) && !empty($data[$key]);
        };
        return in_array(false, array_map($is_set, $keys));
    }
}
